<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    /**
     * Display a listing of businesses
     */
    public function index(Request $request)
    {
        $businesses = Business::with(['user'])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        if ($request->ajax()) {
            return response()->json([
                'businesses' => $businesses->items(),
                'has_more' => $businesses->hasMorePages()
            ]);
        }

        return view('user.dashboard.explore', compact('businesses'));
    }

    /**
     * Show the form for creating a new business
     */
    public function create()
    {
        return view('business.create');
    }

    /**
     * Store a newly created business
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255|unique:businesses',
            'business_email' => 'required|email|unique:businesses',
            'business_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'district' => 'required|string|max:100',
            'postal' => 'required|string|max:10',
            'category' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'business_hours' => 'nullable|array',
            'services' => 'nullable|array',
            'social_links' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $business = new Business();
        $business->user_id = Auth::id();
        $business->business_name = $request->business_name;
        $business->business_email = $request->business_email;
        $business->business_address = $request->business_address;
        $business->phone = $request->phone;
        $business->district = $request->district;
        $business->postal = $request->postal;
        $business->category = $request->category;
        $business->province = $request->province;
        $business->description = $request->description;
        $business->website = $request->website;
        $business->business_hours = $request->business_hours;
        $business->services = $request->services;
        $business->social_links = $request->social_links;
        $business->status = 'pending'; // Pending verification

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('businesses/logos', 'public');
            $business->logo_path = $logoPath;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('businesses/covers', 'public');
            $business->cover_image_path = $coverPath;
        }

        $business->save();

        return response()->json([
            'success' => true,
            'message' => 'Business registered successfully! It will be reviewed for verification.',
            'business' => $business
        ]);
    }

    /**
     * Display the specified business
     */
    public function show($businesses_id)
    {
        $business = Business::with(['user', 'posts.user', 'posts.comments.user'])
            ->findOrFail($businesses_id);

        $isFollowing = false;
        if (Auth::check()) {
            $isFollowing = Follow::where('follower_id', Auth::id())
                                ->where('followable_id', $businesses_id)
                                ->where('followable_type', Business::class)
                                ->where('status', 'active')
                                ->exists();
        }

        $followersCount = Follow::where('followable_id', $businesses_id)
                               ->where('followable_type', Business::class)
                               ->where('status', 'active')
                               ->count();

        $postsCount = Post::where('business_id', $businesses_id)->count();

        return view('business.show', [
            'business' => $business,
            'is_following' => $isFollowing,
            'followers_count' => $followersCount,
            'posts_count' => $postsCount
        ]);
    }

    /**
     * Update the specified business
     */
    public function update(Request $request, $id)
    {
        $business = Business::where('id', $id)
                           ->where('user_id', Auth::id())
                           ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255|unique:businesses,business_name,' . $id,
            'business_email' => 'required|email|unique:businesses,business_email,' . $id,
            'business_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'district' => 'required|string|max:100',
            'postal' => 'required|string|max:10',
            'category' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
            'website' => 'nullable|url|max:255',
            'business_hours' => 'nullable|array',
            'services' => 'nullable|array',
            'social_links' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $business->update($request->only([
            'business_name', 'business_email', 'business_address', 'phone',
            'district', 'postal', 'category', 'province', 'description',
            'website', 'business_hours', 'services', 'social_links'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Business updated successfully!',
            'business' => $business
        ]);
    }

    /**
     * Follow/Unfollow a business
     */
    public function toggleFollow($id)
    {
        $business = Business::findOrFail($id);
        $userId = Auth::id();

        // Prevent following own business
        if ($business->user_id === $userId) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot follow your own business.'
            ], 400);
        }

        $existingFollow = Follow::where('follower_id', $userId)
                               ->where('followable_id', $id)
                               ->where('followable_type', Business::class)
                               ->first();

        if ($existingFollow) {
            $existingFollow->delete();
            $following = false;
            $message = 'Unfollowed business successfully!';
        } else {
            Follow::create([
                'follower_id' => $userId,
                'followable_id' => $id,
                'followable_type' => Business::class,
                'status' => 'active'
            ]);
            $following = true;
            $message = 'Following business successfully!';
        }

        $followersCount = Follow::where('followable_id', $id)
                               ->where('followable_type', Business::class)
                               ->where('status', 'active')
                               ->count();

        return response()->json([
            'success' => true,
            'following' => $following,
            'followers_count' => $followersCount,
            'message' => $message
        ]);
    }

    /**
     * Search businesses with advanced filters
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $location = $request->get('location');
        $province = $request->get('province');
        $district = $request->get('district');
        $verified = $request->get('verified');
        $sortBy = $request->get('sort_by', 'relevance');

        $businesses = Business::with(['user'])
            ->where('status', 'active');

        // Text search
        if ($query) {
            $businesses->where(function($q) use ($query) {
                $q->where('business_name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhereJsonContains('services', $query);
            });
        }

        // Category filter
        if ($category) {
            $businesses->where('category', $category);
        }

        // Location filters
        if ($location) {
            $businesses->where('business_address', 'LIKE', "%{$location}%");
        }

        if ($province) {
            $businesses->where('province', $province);
        }

        if ($district) {
            $businesses->where('district', $district);
        }

        // Verification filter
        if ($verified === 'true') {
            $businesses->where('is_verified', true);
        }

        // Sorting
        switch ($sortBy) {
            case 'newest':
                $businesses->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $businesses->orderBy('created_at', 'asc');
                break;
            case 'name':
                $businesses->orderBy('business_name', 'asc');
                break;
            case 'followers':
                $businesses->withCount('followers')->orderBy('followers_count', 'desc');
                break;
            default:
                $businesses->orderBy('business_name', 'asc');
        }

        $results = $businesses->paginate(12);

        return response()->json([
            'success' => true,
            'businesses' => $results->items(),
            'has_more' => $results->hasMorePages(),
            'total' => $results->total()
        ]);
    }

    /**
     * Get business categories
     */
    public function getCategories()
    {
        $categories = Business::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->sort()
            ->values();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    /**
     * Get business statistics
     */
    public function getStats($id)
    {
        $business = Business::where('id', $id)
                           ->where('user_id', Auth::id())
                           ->firstOrFail();

        $stats = [
            'followers_count' => Follow::where('followable_id', $id)
                                      ->where('followable_type', Business::class)
                                      ->where('status', 'active')
                                      ->count(),
            'posts_count' => Post::where('business_id', $id)->count(),
            'likes_count' => Post::where('business_id', $id)
                                ->withCount('likes')
                                ->get()
                                ->sum('likes_count'),
            'profile_views' => $business->profile_views ?? 0,
            'this_month_followers' => Follow::where('followable_id', $id)
                                           ->where('followable_type', Business::class)
                                           ->where('status', 'active')
                                           ->whereMonth('created_at', now()->month)
                                           ->count()
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }
}
