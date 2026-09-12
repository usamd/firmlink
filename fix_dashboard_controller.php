<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Get products for this user's businesses (if they have any)
        $products = collect(); // Default empty collection
        
        if ($user->businesses && $user->businesses->isNotEmpty()) {
            // Get products from all businesses owned by this user
            $businessIds = $user->businesses->pluck('businesses_id');
            $products = DB::table('product')->whereIn('businesses_id', $businessIds)->get();
        }

        return view('user.dashboard.dashboard', compact('user', 'products'));
    }

    public function explore()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.explore', compact('user'));
    }

    public function notification()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.notification', compact('user'));
    }

    public function newsfeed()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.newsfeed', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Fetch products for user's businesses
        $products = collect();
        
        if ($user->businesses && $user->businesses->isNotEmpty()) {
            $businessIds = $user->businesses->pluck('businesses_id');
            $products = DB::table('product')->whereIn('businesses_id', $businessIds)->get();
        }

        return view('user.dashboard.profile', compact('user', 'products'));
    }

    public function settings()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.settings', compact('user'));
    }

    public function analytics()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.analytics', compact('user'));
    }

    public function promotions()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.promotions', compact('user'));
    }

    public function partnerships()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.partnerships', compact('user'));
    }

    public function events()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.dashboard.events', compact('user'));
    }
}
