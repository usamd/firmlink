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

        // Start building the query
        $businesses = Business::query();
            
        // Apply search query if provided
        if (!empty($query)) {
            $businesses->where(function($q) use ($query) {
                $q->where('business_name', 'like', "%{$query}%")
                  ->orWhere('business_address', 'like', "%{$query}%")
                  ->orWhere('district', 'like', "%{$query}%")
                  ->orWhere('province', 'like', "%{$query}%");
            });
        }
        
        // Apply location filter if provided
        if (!empty($location)) {
            $businesses->where(function($q) use ($location) {
                $q->where('district', 'like', "%{$location}%")
                  ->orWhere('province', 'like', "%{$location}%")
                  ->orWhere('business_address', 'like', "%{$location}%");
            });
        }

        // Apply category filter if provided
        if (!empty($category)) {
            $businesses->where('category', $category);
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
            
        // Paginate the results with reviews count and average rating
        $businesses = $businesses->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->paginate(12)
            ->appends($request->except('page'));
        
        // Return the view with the search results
        return view('search.results', [
            'businesses' => $businesses,
            'locations' => $locations,
            'categories' => $categories,
            'query' => $query,
            'location' => $location,
        ]);
    }
    
}
