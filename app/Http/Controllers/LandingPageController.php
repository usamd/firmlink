<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $businessCount = Business::count();
        $userCount = User::count();
        
        // Get categories with business counts
        $categories = Category::withCount(['businesses' => function($query) {
                $query->where('is_verified', true);
            }])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('LandPage', compact('businessCount', 'userCount', 'categories'));
    }
}
