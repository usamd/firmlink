<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Show the search results page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get search parameters with default empty values
        $query = $request->input('query', '');
        $location = $request->input('location', '');
        $category = $request->input('category');
        $minRating = $request->input('rating');
        $sort = $request->input('sort', 'relevance');
        $features = $request->input('features', []);

        // Start building the query and select necessary fields
        $businesses = Business::select('*');
            
        // Store original location for display - don't set a default value here
        $originalLocation = $request->input('location');
        
        // Convert search terms to lowercase for case-insensitive search
        $query = strtolower($query);
        $location = strtolower($originalLocation);
        
        // Apply filters
        $businesses->where(function($q) use ($query, $location) {
            // If there's a search query
            if (!empty($query)) {
                $q->where(function($q) use ($query) {
                    $q->whereRaw('LOWER(business_name) LIKE ?', ["%{$query}%"])
                      ->orWhereRaw('LOWER(business_address) LIKE ?', ["%{$query}%"])
                      ->orWhereRaw('LOWER(business_email) LIKE ?', ["%{$query}%"])
                      ->orWhereRaw('REPLACE(phone, " ", "") LIKE ?', ["%" . str_replace(' ', '', $query) . "%"]);
                });
            }
            
            // Only apply location filter if a location was provided
            if (!empty($location)) {
                $q->where(function($q) use ($location) {
                    $q->whereRaw('LOWER(district) LIKE ?', ["%{$location}%"])
                      ->orWhereRaw('LOWER(province) LIKE ?', ["%{$location}%"]);
                });
            }
        });

        // Apply category filter if provided
        if (!empty($category)) {
            $businesses->where('category_id', $category);
        }

        // Apply minimum rating filter
        if ($minRating) {
            $businesses->whereHas('reviews', function($q) use ($minRating) {
                $q->select(DB::raw('AVG(rating) as avg_rating'))
                  ->groupBy('business_id')
                  ->having('avg_rating', '>=', $minRating);
            });
        }

        // Apply features filter (if any)
        if (is_array($features) && count($features) > 0) {
            foreach ($features as $feature) {
                switch ($feature) {
                    case 'wifi':
                        $businesses->where('has_wifi', true);
                        break;
                    case 'parking':
                        $businesses->where('has_parking', true);
                        break;
                    case 'delivery':
                        $businesses->where('has_delivery', true);
                        break;
                }
            }
        }

        // Apply sorting
        switch ($sort) {
            case 'rating':
                $businesses->withCount(['reviews as average_rating' => function($query) {
                    $query->select(DB::raw('coalesce(avg(rating),0)'));
                }])->orderBy('average_rating', 'desc');
                break;
                
            case 'newest':
                $businesses->latest('created_at');
                break;
                
            case 'name_asc':
                $businesses->orderBy('business_name', 'asc');
                break;
                
            case 'name_desc':
                $businesses->orderBy('business_name', 'desc');
                break;
                
            case 'relevance':
            default:
                // Default sorting by relevance (business name match first, then address)
                if (!empty($query)) {
                    $businesses->orderByRaw(
                        "CASE 
                            WHEN business_name LIKE ? THEN 1 
                            WHEN business_address LIKE ? THEN 2 
                            ELSE 3 
                        END", 
                        ["%{$query}%", "%{$query}%"]
                    );
                }
                $businesses->orderBy('created_at', 'desc');
                break;
        }

        // Get unique locations for the location dropdown
        $locations = Business::select('district')
            ->whereNotNull('district')
            ->where('district', '!=', '')
            ->distinct()
            ->orderBy('district')
            ->pluck('district');
            
        // Get all categories for the category filter
        $categories = Category::orderBy('name')->get();
            
        // Debug: Get the raw SQL query
        $sql = $businesses->toSql();
        \Log::info('Search Query:', [
            'sql' => $sql,
            'bindings' => $businesses->getBindings(),
            'request' => $request->all()
        ]);
            
        // Add debug logging
        \Log::info('Businesses query:', ['sql' => $businesses->toSql(), 'bindings' => $businesses->getBindings()]);
            
        // Eager load relationships and paginate results
        $businesses = $businesses->with(['reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->paginate(12)
            ->appends($request->except('page'));
            
        // Debug the first business
        if ($businesses->count() > 0) {
            \Log::info('First business data:', $businesses->first()->toArray());
        }
        
        // Return the view with the search results
        return view('search.results', [
            'businesses' => $businesses,
            'query' => $request->input('query', ''), // Use original query case
            'location' => $originalLocation, // Use original location case
            'locations' => $locations,
            'categories' => $categories
        ]);
    }
    
}