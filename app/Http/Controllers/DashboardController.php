<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userID = 1; // Replace with actual logged-in user ID logic
        $users = DB::table('users')->where('id', $userID)->first();
        $products = DB::table('product')->where('businesses_id', $users->id)->get();

        return view('user.dashboard.dashboard', compact('users', 'products'));
    }

    public function explore()
    {
        $userID = 1; // Replace with actual logged-in user ID logic
        $users = DB::table('users')->where('id', $userID)->first();

        return view('user.dashboard.explore', compact('users'));
    }

    public function notification()
    {
        $userID = 1; // Replace with actual logged-in user ID logic
        $users = DB::table('users')->where('id', $userID)->first();

        return view('user.dashboard.notification', compact('users'));
    }

    public function newsfeed()
    {
        $userID = 1; // Replace with actual logged-in user ID logic
        $users = DB::table('users')->where('id', $userID)->first();

        return view('user.dashboard.newsfeed', compact('users'));
    }

    public function profile()
    {
        $userID = 1; // Replace with actual logged-in user ID logic
        $users = DB::table('users')->where('id', $userID)->first();
        
        // Fetch products for the user (assuming you have a products table)
        // If you don't have a products table yet, this will return an empty collection
        $products = collect([]); // Empty collection as placeholder
        // Uncomment and modify this line when you have a products table:
        // $products = DB::table('products')->where('user_id', $userID)->get();

        return view('user.dashboard.profile', compact('users', 'products'));
    }

    public function settings()
    {
        $userID = 1; // Replace with actual logged-in user ID logic
        $users = DB::table('users')->where('id', $userID)->first();

        return view('user.dashboard.settings', compact('users'));
    }
}
