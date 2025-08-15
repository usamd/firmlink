<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Authentication required',
                    'message' => 'You must be logged in to access this resource.'
                ], 401);
            }
            
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $user = Auth::user();

        // Check if user account is active
        if (!$user->isActive()) {
            Auth::logout();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Account inactive',
                    'message' => 'Your account has been deactivated. Please contact support.'
                ], 403);
            }
            
            return redirect()->route('login')->with('error', 'Your account has been deactivated.');
        }

        // Check if user has admin role
        if (!$user->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Access denied',
                    'message' => 'You do not have permission to access this resource.'
                ], 403);
            }
            
            return redirect()->route('user.dashboard')->with('error', 'Access denied. Admin privileges required.');
        }

        // Check specific admin permissions if provided
        $permission = $request->route()->getAction('permission');
        if ($permission && !$user->role->hasPermission($permission)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Insufficient permissions',
                    'message' => "You do not have the required permission: {$permission}"
                ], 403);
            }
            
            return redirect()->back()->with('error', 'You do not have sufficient permissions for this action.');
        }

        return $next($request);
    }
}
