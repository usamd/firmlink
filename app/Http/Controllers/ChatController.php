<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show chat interface
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get(['id', 'name', 'email', 'avatar']);
        return view('chat.index', compact('users'));
    }

    /**
     * Get list of all users except the current user
     * Shows all registered users in the system
     */
    public function getUsers()
    {
        $users = User::where('id', '!=', Auth::id())
            ->select([
                'id',
                'name',
                'email',
                'avatar',
                'created_at',
                'last_login_at'
            ])
            ->orderBy('name', 'asc')
            ->get()
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar ?? asset('images/default-avatar.png'),
                    'is_online' => $user->last_login_at && $user->last_login_at->gt(now()->subMinutes(5)),
                    'last_seen' => $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never',
                    'member_since' => $user->created_at->format('M Y')
                ];
            });
            
        return response()->json([
            'status' => 'success',
            'users' => $users
        ]);
    }

    /**
     * Get messages between authenticated user and another user
     */
    public function getMessages($userId)
    {
        $messages = Message::where(function($query) use ($userId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $userId);
            })
            ->orWhere(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', Auth::id());
            })
            ->with(['sender:id,name,avatar', 'receiver:id,name,avatar'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

    /**
     * Send a new message
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Load sender and receiver relationships
        $message->load(['sender:id,name,avatar', 'receiver:id,name,avatar']);

        return response()->json([
            'status' => 'Message sent successfully',
            'message' => $message
        ], 201);
    }
}
