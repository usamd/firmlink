<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Get the authenticated user
        $user = $request->user();
        
        // Update last login timestamp
        $user->update(['last_login_at' => now()]);

        // Role-based redirect after login
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome to Admin Dashboard!');
        } elseif ($user->isBusiness()) {
            return redirect()->route('business.dashboard')->with('success', 'Welcome back! Manage your business profile and posts.');
        } else {
            return redirect()->route('user.dashboard')->with('success', 'Welcome back to BizNest!');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
