<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of posts for newsfeed
     */
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'business', 'comments.user', 'likes'])
            ->active()
            ->public()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'posts' => $posts->items(),
                'has_more' => $posts->hasMorePages()
            ]);
        }

        return view('user.dashboard.newsfeed', compact('posts'));
    }

    /**
     * Store a new post
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'video' => 'nullable|mimes:mp4,mov,avi|max:51200',
            'business_id' => 'nullable|exists:businesses,id',
            'post_type' => 'required|in:text,image,video,story,promotion',
            'privacy_level' => 'required|in:public,private,friends',
            'location' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->content;
        $post->post_type = $request->post_type;
        $post->privacy_level = $request->privacy_level;
        $post->location = $request->location;
        $post->tags = $request->tags ?? [];
        $post->status = 'active';

        if ($request->business_id) {
            // Verify user owns the business
            $business = Business::where('id', $request->business_id)
                              ->where('user_id', Auth::id())
                              ->first();
            if ($business) {
                $post->business_id = $request->business_id;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts/images', 'public');
            $post->image_path = $imagePath;
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('posts/videos', 'public');
            $post->video_path = $videoPath;
        }

        $post->save();

        // Load relationships for response
        $post->load(['user', 'business', 'comments.user', 'likes']);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
            'post' => $post
        ]);
    }

    /**
     * Show a specific post
     */
    public function show($id)
    {
        $post = Post::with(['user', 'business', 'comments.user.business', 'likes.user'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'post' => $post
        ]);
    }

    /**
     * Update a post
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)
                   ->where('user_id', Auth::id())
                   ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:5000',
            'privacy_level' => 'required|in:public,private,friends',
            'location' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $post->update([
            'content' => $request->content,
            'privacy_level' => $request->privacy_level,
            'location' => $request->location,
            'tags' => $request->tags ?? []
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully!',
            'post' => $post
        ]);
    }

    /**
     * Delete a post
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)
                   ->where('user_id', Auth::id())
                   ->firstOrFail();

        // Delete associated files
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        if ($post->video_path) {
            Storage::disk('public')->delete($post->video_path);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully!'
        ]);
    }

    /**
     * Like/Unlike a post
     */
    public function toggleLike(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $userId = Auth::id();

        $existingLike = Like::where('user_id', $userId)
                           ->where('likeable_id', $id)
                           ->where('likeable_type', Post::class)
                           ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $userId,
                'likeable_id' => $id,
                'likeable_type' => Post::class,
                'reaction_type' => $request->reaction_type ?? 'like'
            ]);
            $liked = true;
        }

        $likesCount = $post->likes()->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }

    /**
     * Add a comment to a post
     */
    public function addComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $post = Post::findOrFail($id);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'status' => 'active'
        ]);

        $comment->load(['user', 'replies.user']);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully!',
            'comment' => $comment
        ]);
    }

    /**
     * Get promoted/sponsored posts
     */
    public function getPromotedPosts()
    {
        $promotedPosts = Post::with(['user', 'business'])
            ->promoted()
            ->active()
            ->public()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'posts' => $promotedPosts
        ]);
    }

    /**
     * Search posts
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $type = $request->get('type', 'all');
        $location = $request->get('location');

        $posts = Post::with(['user', 'business'])
            ->active()
            ->public();

        if ($query) {
            $posts->where(function($q) use ($query) {
                $q->where('content', 'LIKE', "%{$query}%")
                  ->orWhereJsonContains('tags', $query);
            });
        }

        if ($type !== 'all') {
            $posts->byType($type);
        }

        if ($location) {
            $posts->where('location', 'LIKE', "%{$location}%");
        }

        $results = $posts->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'posts' => $results->items(),
            'has_more' => $results->hasMorePages()
        ]);
    }
}
