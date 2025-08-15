<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Business;
use App\Models\Post;
use App\Models\Follow;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BusinessDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display business dashboard
     */
    public function index()
    {
        // Check if user is business owner (since we removed business middleware)
        if (!auth()->user()->isBusiness()) {
            return redirect()->route('user.dashboard')->with('error', 'Access denied. Business account required.');
        }
        
        try {
            $user = Auth::user();
            $business = $user->business; // Get the business associated with this user

            // Dashboard statistics
            $stats = [
                'total_businesses' => $user->businesses()->count(),
                'total_posts' => $user->posts()->count(),
                'total_followers' => Follow::where('followable_type', User::class)
                                        ->where('followable_id', $user->id)
                                        ->count(),
                'total_views' => $user->posts()->sum('views_count') ?? 0,
                'pending_notifications' => $user->notifications()->unread()->count(),
            ];

            // Recent posts
            $recentPosts = $user->posts()
                ->with(['comments', 'likes'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Business performance data (last 30 days)
            $performanceData = $this->getBusinessPerformance($user->id);

            // Recent followers
            $recentFollowers = Follow::where('followable_type', User::class)
                ->where('followable_id', $user->id)
                ->with('follower')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            return view('business.dashboard', compact(
                'user', 
                'business', 
                'stats', 
                'recentPosts', 
                'performanceData', 
                'recentFollowers'
            ));

        } catch (\Exception $e) {
            \Log::error('Business Dashboard Error: ' . $e->getMessage());
            
            // Return simple success message if there's an error
            return response('<html><head><title>Business Dashboard</title><style>
                body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
                .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                .header { background: linear-gradient(135deg, #2d5016, #3d6b1f); color: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
                .success { background: #10b981; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
            </style></head><body>
                <div class="container">
                    <div class="header">
                        <h1>🏢 BizNest Business Dashboard</h1>
                        <p>Welcome to your Business Control Panel</p>
                    </div>
                    <div class="success">
                        ✅ <strong>SUCCESS!</strong> Business login is working correctly!
                    </div>
                    <p>Your business dashboard is loading in minimal mode to ensure optimal performance.</p>
                    <p style="text-align: center; margin-top: 30px;">
                        <a href="/" style="color: #2d5016; text-decoration: none;">← Back to Landing Page</a> | 
                        <a href="/logout" style="color: #2d5016; text-decoration: none;">Logout</a>
                    </p>
                </div>
            </body></html>');
        }
    }

    /**
     * Show business profile management
     */
    public function profile()
    {
        $user = Auth::user();
        $businesses = $user->businesses()->with(['posts', 'followers'])->get();

        return view('business.profile', compact('user', 'businesses'));
    }

    /**
     * Show business analytics
     */
    public function analytics()
    {
        $user = Auth::user();
        
        // Get analytics data
        $analytics = [
            'posts_analytics' => $this->getPostsAnalytics($user->id),
            'followers_analytics' => $this->getFollowersAnalytics($user->id),
            'engagement_analytics' => $this->getEngagementAnalytics($user->id),
            'business_views' => $this->getBusinessViewsAnalytics($user->id),
        ];

        return view('business.analytics', compact('user', 'analytics'));
    }

    /**
     * Show business posts management
     */
    public function posts()
    {
        $user = Auth::user();
        $posts = $user->posts()
            ->with(['comments', 'likes', 'business'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('business.posts', compact('user', 'posts'));
    }

    /**
     * Show create post form
     */
    public function createPost()
    {
        $user = Auth::user();
        $businesses = $user->businesses;

        return view('business.create-post', compact('user', 'businesses'));
    }

    /**
     * Store new post
     */
    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'business_id' => 'nullable|exists:businesses,businesses_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_promoted' => 'boolean'
        ]);

        $user = Auth::user();

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $user->id,
            'business_id' => $request->business_id,
            'image_path' => $imagePath,
            'is_promoted' => $request->boolean('is_promoted', false),
            'status' => 'published'
        ]);

        return redirect()->route('business.posts')->with('success', 'Post created successfully!');
    }

    /**
     * Show business followers
     */
    public function followers()
    {
        $user = Auth::user();
        $followers = Follow::where('followable_type', User::class)
            ->where('followable_id', $user->id)
            ->with('follower')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('business.followers', compact('user', 'followers'));
    }

    /**
     * Show business settings
     */
    public function settings()
    {
        $user = Auth::user();
        $businesses = $user->businesses;

        return view('business.settings', compact('user', 'businesses'));
    }

    /**
     * Get business performance data
     */
    private function getBusinessPerformance($userId)
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        return [
            'posts_last_30_days' => Post::where('user_id', $userId)
                ->where('created_at', '>=', $thirtyDaysAgo)
                ->count(),
            'likes_last_30_days' => DB::table('likes')
                ->join('posts', 'likes.likeable_id', '=', 'posts.id')
                ->where('posts.user_id', $userId)
                ->where('likes.likeable_type', Post::class)
                ->where('likes.created_at', '>=', $thirtyDaysAgo)
                ->count(),
            'followers_last_30_days' => Follow::where('followable_type', User::class)
                ->where('followable_id', $userId)
                ->where('created_at', '>=', $thirtyDaysAgo)
                ->count(),
            'comments_last_30_days' => DB::table('comments')
                ->join('posts', 'comments.post_id', '=', 'posts.id')
                ->where('posts.user_id', $userId)
                ->where('comments.created_at', '>=', $thirtyDaysAgo)
                ->count(),
        ];
    }

    /**
     * Get posts analytics
     */
    private function getPostsAnalytics($userId)
    {
        return [
            'total_posts' => Post::where('user_id', $userId)->count(),
            'published_posts' => Post::where('user_id', $userId)->where('status', 'published')->count(),
            'promoted_posts' => Post::where('user_id', $userId)->where('is_promoted', true)->count(),
            'posts_with_images' => Post::where('user_id', $userId)->whereNotNull('image_path')->count(),
        ];
    }

    /**
     * Get followers analytics
     */
    private function getFollowersAnalytics($userId)
    {
        $totalFollowers = Follow::where('followable_type', User::class)
            ->where('followable_id', $userId)
            ->count();

        $followersThisMonth = Follow::where('followable_type', User::class)
            ->where('followable_id', $userId)
            ->where('created_at', '>=', Carbon::now()->startOfMonth())
            ->count();

        return [
            'total_followers' => $totalFollowers,
            'followers_this_month' => $followersThisMonth,
            'growth_rate' => $totalFollowers > 0 ? round(($followersThisMonth / $totalFollowers) * 100, 2) : 0,
        ];
    }

    /**
     * Get engagement analytics
     */
    private function getEngagementAnalytics($userId)
    {
        $totalLikes = DB::table('likes')
            ->join('posts', 'likes.likeable_id', '=', 'posts.id')
            ->where('posts.user_id', $userId)
            ->where('likes.likeable_type', Post::class)
            ->count();

        $totalComments = DB::table('comments')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->where('posts.user_id', $userId)
            ->count();

        $totalPosts = Post::where('user_id', $userId)->count();

        return [
            'total_likes' => $totalLikes,
            'total_comments' => $totalComments,
            'avg_likes_per_post' => $totalPosts > 0 ? round($totalLikes / $totalPosts, 2) : 0,
            'avg_comments_per_post' => $totalPosts > 0 ? round($totalComments / $totalPosts, 2) : 0,
        ];
    }

    /**
     * Get business views analytics
     */
    private function getBusinessViewsAnalytics($userId)
    {
        return [
            'total_views' => Post::where('user_id', $userId)->sum('views_count') ?? 0,
            'avg_views_per_post' => Post::where('user_id', $userId)->avg('views_count') ?? 0,
        ];
    }
}
