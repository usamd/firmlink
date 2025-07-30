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
use Illuminate\Support\Facades\Route;

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('about-us', [AboutUsController::class, 'AboutUsIndex'])->name('about_us');

Route::get('/user/dashboard/dashboard', [DashboardController::class, 'index'])->name('user.dashboard.dashboard');
Route::get('/user/dashboard/explore', [DashboardController::class, 'explore']);
Route::get('/user/dashboard/notification', [DashboardController::class, 'notification']);
Route::get('/user/dashboard/newsfeed', [DashboardController::class, 'newsfeed']);
Route::get('/user/dashboard/profile', [DashboardController::class, 'profile']);

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/settings', [UserController::class, 'settings'])->name('settings');
Route::get('/userdetails', [ProfileController::class, 'edit'])->middleware('auth');
// Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
Route::get('/users', [ChatController::class, 'getUsers']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/dashboard/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::controller(MessageController::class)->group(function(){
    Route::get('messages', 'sendMessages');
    Route::get('messages', 'fetchMessages');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/update', [UserController::class, 'update']);
});
