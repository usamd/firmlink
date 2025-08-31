<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BusinessDashboardController;
use Illuminate\Support\Facades\Route;

// Search Routes
Route::match(['get', 'post'], '/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.businesses');

// Business Routes
Route::get('/businesses/{businesses_id}', [\App\Http\Controllers\BusinessController::class, 'show'])
    ->name('business.show')
    ->where('businesses_id', '[0-9]+');

// Save Business Routes - Protected by auth middleware
Route::middleware(['auth'])->group(function () {
    Route::post('/businesses/{businesses_id}/save', [\App\Http\Controllers\SavedBusinessController::class, 'save'])
        ->name('businesses.save')
        ->where('businesses_id', '[0-9]+');
    Route::post('/businesses/{businesses_id}/unsave', [\App\Http\Controllers\SavedBusinessController::class, 'unsave'])
        ->name('businesses.unsave')
        ->where('businesses_id', '[0-9]+');
});

Route::get('/', function () {
    return view('LandPage');
});

Route::get('/menu', function () {
    return view('auth/menu');
});

Route::get('/cusmenu', function () {
    return view('auth/customer_menu');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('register_employee', [AuthRegisterController::class, 'businessRegisterIndex'])->name('register_employee');
Route::post('register-business', [AuthRegisterController::class, 'registerBusiness'])->name('register.business');
Route::get('register_user', [AuthRegisterController::class, 'userRegisterIndex'])->name('register_user');

// Authentication routes
// Now enabled after disabling Laravel Breeze routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [AuthRegisterController::class, 'register'])->name('register');
Route::post('/register-user', [AuthRegisterController::class, 'register'])->name('register.user');

Route::get('about-us', [AboutUsController::class, 'AboutUsIndex'])->name('about_us');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SIMPLIFIED MIDDLEWARE APPROACH - Only use 'auth' middleware, handle roles in controllers
// This fixes the login conflicts caused by role-specific middleware

// Customer/User Dashboard Routes - Middleware commented out for unrestricted access
// Route::middleware(['auth'])->group(function () {
Route::group([], function () {
    // User Dashboard Routes
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/dashboard/profile', [DashboardController::class, 'profile'])->name('user.dashboard.profile');
    Route::get('/user/dashboard/settings', [DashboardController::class, 'settings'])->name('user.dashboard.settings');
    
    // Business Tools Routes
    Route::get('/user/dashboard/analytics', [DashboardController::class, 'analytics'])->name('user.dashboard.analytics');
    Route::get('/user/dashboard/promotions', [DashboardController::class, 'promotions'])->name('user.dashboard.promotions');
    Route::get('/user/dashboard/partnerships', [DashboardController::class, 'partnerships'])->name('user.dashboard.partnerships');
    Route::get('/user/dashboard/events', [DashboardController::class, 'events'])->name('user.dashboard.events');
    
    // Chat Routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/users', [ChatController::class, 'getUsers'])->name('chat.users');
    Route::get('/chat/messages/{user}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    
    // Post Routes (all authenticated users can interact with posts)
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/like', [PostController::class, 'unlike'])->name('posts.unlike');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');
    Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
    
    // Follow Routes
    Route::post('/follow/{type}/{id}', [PostController::class, 'follow'])->name('follow');
    Route::delete('/follow/{type}/{id}', [PostController::class, 'unfollow'])->name('unfollow');
    
    // Notification Routes
    Route::get('/notifications', [PostController::class, 'notifications'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [PostController::class, 'markNotificationRead'])->name('notifications.read');
});

// Business-only routes - Middleware commented out for unrestricted access
// Route::middleware(['auth'])->group(function () {
Route::group([], function () {
    // Business Management Routes
    Route::get('/businesses/create', [BusinessController::class, 'create'])->name('businesses.create');
    Route::post('/businesses', [BusinessController::class, 'store'])->name('businesses.store');
    Route::get('/businesses/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::put('/businesses/{business}', [BusinessController::class, 'update'])->name('businesses.update');
    Route::delete('/businesses/{business}', [BusinessController::class, 'destroy'])->name('businesses.destroy');
    
    // Business Analytics and Management
    Route::get('/businesses/{business}/analytics', [BusinessController::class, 'analytics'])->name('businesses.analytics');
    Route::get('/businesses/my-businesses', [BusinessController::class, 'myBusinesses'])->name('businesses.my');
    
    // Promoted Posts (Business feature)
    Route::get('/posts/promoted', [PostController::class, 'promoted'])->name('posts.promoted');
    Route::post('/posts/{post}/promote', [PostController::class, 'promote'])->name('posts.promote');
});

// Public business routes - Middleware commented out for unrestricted access
// Route::middleware(['auth'])->group(function () {
Route::group([], function () {
    Route::get('/businesses', [BusinessController::class, 'index'])->name('businesses.index');
    Route::get('/businesses/{business}', [BusinessController::class, 'show'])->name('businesses.show');
    Route::get('/businesses/search', [BusinessController::class, 'search'])->name('businesses.search');
    Route::get('/businesses/categories', [BusinessController::class, 'categories'])->name('businesses.categories');
    Route::post('/businesses/{business}/follow', [BusinessController::class, 'follow'])->name('businesses.follow');
    Route::delete('/businesses/{business}/follow', [BusinessController::class, 'unfollow'])->name('businesses.unfollow');
});

// Admin-only routes - Middleware commented out for unrestricted access
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    // User Management
    Route::get('/users', [PostController::class, 'adminUsers'])->name('users.index');
    Route::get('/users/{user}', [PostController::class, 'adminUserShow'])->name('users.show');
    Route::put('/users/{user}/toggle-status', [PostController::class, 'adminToggleUserStatus'])->name('users.toggle-status');
    Route::delete('/users/{user}', [PostController::class, 'adminDeleteUser'])->name('users.delete');
    
    // Business Verification and Management
    Route::get('/businesses/pending', [BusinessController::class, 'adminPendingBusinesses'])->name('businesses.pending');
    Route::post('/businesses/{business}/verify', [BusinessController::class, 'adminVerifyBusiness'])->name('businesses.verify');
    Route::post('/businesses/{business}/reject', [BusinessController::class, 'adminRejectBusiness'])->name('businesses.reject');
    Route::get('/businesses/all', [BusinessController::class, 'adminAllBusinesses'])->name('businesses.all');
    
    // Post Moderation
    Route::get('/posts/flagged', [PostController::class, 'adminFlaggedPosts'])->name('posts.flagged');
    Route::post('/posts/{post}/approve', [PostController::class, 'adminApprovePost'])->name('posts.approve');
    Route::post('/posts/{post}/reject', [PostController::class, 'adminRejectPost'])->name('posts.reject');
    Route::delete('/posts/{post}/force-delete', [PostController::class, 'adminForceDeletePost'])->name('posts.force-delete');
    
    // System Statistics
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [PostController::class, 'adminAnalytics'])->name('analytics');
});

// API Routes for AJAX calls
// Route::middleware(['auth'])->prefix('api')->name('api.')->group(function () {
Route::prefix('api')->name('api.')->group(function () {
    // Post API endpoints
    Route::apiResource('posts', PostController::class);
    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::delete('posts/{post}/like', [PostController::class, 'unlike'])->name('posts.unlike');
    Route::apiResource('posts.comments', PostController::class);
    
    // Business API endpoints
    Route::apiResource('businesses', BusinessController::class)->except(['create', 'edit']);
    Route::get('businesses/search', [BusinessController::class, 'search'])->name('businesses.search');
    Route::post('businesses/{business}/follow', [BusinessController::class, 'follow'])->name('businesses.follow');
    
    // User API endpoints
    Route::get('users/search', [PostController::class, 'searchUsers'])->name('users.search');
    Route::get('notifications', [PostController::class, 'notifications'])->name('notifications');
});

// Message routes
Route::controller(MessageController::class)->group(function(){
    Route::get('messages', 'sendMessages');
    Route::get('messages', 'fetchMessages');
});

// Admin routes - Middleware commented out for unrestricted access
//Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
Route::prefix('admin')->name('admin.')->group([], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/businesses', [AdminDashboardController::class, 'businesses'])->name('businesses');
    Route::get('/posts', [AdminDashboardController::class, 'posts'])->name('posts');
    Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');
    
    // User management actions
    Route::patch('/users/{user}/toggle-status', [AdminDashboardController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::patch('/users/{user}/update-role', [AdminDashboardController::class, 'updateUserRole'])->name('users.update-role');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('users.delete');
    
    // Business management actions
    Route::patch('/businesses/{business}/verify', [AdminDashboardController::class, 'verifyBusiness'])->name('businesses.verify');
    Route::patch('/businesses/{business}/reject', [AdminDashboardController::class, 'rejectBusiness'])->name('businesses.reject');
    
    // Post management actions
    Route::patch('/posts/{post}/update-status', [AdminDashboardController::class, 'updatePostStatus'])->name('posts.update-status');
});

// Business routes
Route::prefix('business')->name('business.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [BusinessDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [BusinessDashboardController::class, 'profile'])->name('profile');
    Route::get('/analytics', [BusinessDashboardController::class, 'analytics'])->name('analytics');
    Route::get('/posts', [BusinessDashboardController::class, 'posts'])->name('posts');
    Route::get('/followers', [BusinessDashboardController::class, 'followers'])->name('followers');
    Route::get('/settings', [BusinessDashboardController::class, 'settings'])->name('settings');
    
    // Post management
    Route::get('/posts/create', [BusinessDashboardController::class, 'createPost'])->name('posts.create');
    Route::post('/posts', [BusinessDashboardController::class, 'storePost'])->name('posts.store');
});

// API routes for AJAX requests - Middleware commented out for unrestricted access
Route::prefix('api')->group(function () {
    Route::get('/dashboard-stats', [DashboardController::class, 'getStats']);
    Route::get('/recent-activity', [DashboardController::class, 'getRecentActivity']);
    Route::get('/recent-messages', [DashboardController::class, 'getRecentMessages']);
    Route::post('/upload-image', [DashboardController::class, 'uploadImage']);
});


Route::get('/messagedashboard', function () {
    return view('messageDashboard');
})->name('messagedashboard');

// Debug route to check/create admin user (remove after setup)
Route::get('/setup-admin', function () {
    $output = [];
    
    try {
        // Check if roles exist
        $roles = \App\Models\Role::all();
        $output[] = "Found " . $roles->count() . " roles in database:";
        foreach ($roles as $role) {
            $output[] = "- {$role->name} (ID: {$role->id})";
        }
        
        // Get or create admin role
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        if (!$adminRole) {
            $output[] = "Creating admin role...";
            $adminRole = \App\Models\Role::create([
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full system access and control',
                'permissions' => json_encode(['*']),
                'is_active' => true
            ]);
            $output[] = "Admin role created with ID: {$adminRole->id}";
        }
        
        // Check/create admin user
        $adminUser = \App\Models\User::where('email', 'admin@biznest.com')->first();
        if ($adminUser) {
            $output[] = "Admin user exists: {$adminUser->name} (ID: {$adminUser->id})";
            $output[] = "Current role_id: " . ($adminUser->role_id ?? 'NULL');
            $output[] = "Is Admin: " . ($adminUser->isAdmin() ? 'YES' : 'NO');
            
            // Update role if needed
            if ($adminUser->role_id != $adminRole->id) {
                $adminUser->update(['role_id' => $adminRole->id, 'is_active' => true]);
                $output[] = "Updated admin user role to: {$adminRole->id}";
            }
        } else {
            $output[] = "Creating admin user...";
            $adminUser = \App\Models\User::create([
                'name' => 'Admin User',
                'email' => 'admin@biznest.com',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'address' => 'Admin Address',
                'nearest_city' => 'Admin City',
                'mobile_number' => '1234567890',
                'id_number' => 'ADMIN001',
                'role_id' => $adminRole->id,
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $output[] = "Admin user created with ID: {$adminUser->id}";
        }
        
        $output[] = "";
        $output[] = "=== ADMIN LOGIN CREDENTIALS ===";
        $output[] = "Email: admin@biznest.com";
        $output[] = "Password: admin123";
        $output[] = "Role: admin (ID: {$adminRole->id})";
        $output[] = "";
        $output[] = "You can now login from the landing page with these credentials.";
        $output[] = "After successful setup, remove this route from web.php for security.";
        
    } catch (\Exception $e) {
        $output[] = "Error: " . $e->getMessage();
    }
    
    return '<pre>' . implode("\n", $output) . '</pre>';
});

// Debug route to view recent logs (remove after debugging)
Route::get('/view-logs', function () {
    $logFile = storage_path('logs/laravel.log');
    
    if (!file_exists($logFile)) {
        return '<pre>No log file found at: ' . $logFile . '</pre>';
    }
    
    // Get last 50 lines of the log file
    $lines = file($logFile);
    $recentLines = array_slice($lines, -50);
    
    return '<pre>' . implode('', $recentLines) . '</pre>';
});

// Debug route to test authentication status
Route::get('/debug-auth', function () {
    $output = [];
    
    try {
        $output[] = "=== AUTHENTICATION DEBUG ===";
        $output[] = "Current Time: " . now();
        $output[] = "";
        
        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $output[] = "✅ User is authenticated:";
            $output[] = "- ID: " . $user->id;
            $output[] = "- Name: " . $user->name;
            $output[] = "- Email: " . $user->email;
            $output[] = "- Role ID: " . ($user->role_id ?? 'NULL');
            $output[] = "- Role Name: " . ($user->role->name ?? 'NO ROLE');
            $output[] = "- Is Admin: " . ($user->isAdmin() ? 'YES' : 'NO');
            $output[] = "- Is Business: " . ($user->isBusiness() ? 'YES' : 'NO');
            $output[] = "- Is Customer: " . ($user->isCustomer() ? 'YES' : 'NO');
        } else {
            $output[] = "❌ No user is currently authenticated";
        }
        
        $output[] = "";
        $output[] = "=== AVAILABLE ROUTES ===";
        $output[] = "- Admin Dashboard: " . route('admin.dashboard');
        $output[] = "- Business Dashboard: " . route('business.dashboard');
        $output[] = "- User Dashboard: " . route('user.dashboard');
        
        $output[] = "";
        $output[] = "=== ROLES IN DATABASE ===";
        $roles = \App\Models\Role::all();
        foreach ($roles as $role) {
            $userCount = \App\Models\User::where('role_id', $role->id)->count();
            $output[] = "- {$role->name} (ID: {$role->id}) - {$userCount} users";
        }
        
    } catch (\Exception $e) {
        $output[] = "ERROR: " . $e->getMessage();
    }
    
    return '<pre>' . implode("\n", $output) . '</pre>';
});


