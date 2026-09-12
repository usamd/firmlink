<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use App\Models\Business;
use App\Models\Post;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

echo "=== DATABASE OPERATIONS DEMO ===\n\n";

// 1. Check existing roles
echo "📋 Available Roles:\n";
$roles = Role::all();
foreach ($roles as $role) {
    echo "- ID: {$role->id}, Name: {$role->name}, Display: {$role->display_name}\n";
}

if ($roles->isEmpty()) {
    echo "No roles found. Creating default roles...\n";
    $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Administrator', 'is_active' => true]);
    $businessRole = Role::create(['name' => 'business', 'display_name' => 'Business Owner', 'is_active' => true]);
    $customerRole = Role::create(['name' => 'customer', 'display_name' => 'Customer', 'is_active' => true]);
    echo "Created default roles.\n";
}

echo "\n";

// 2. Create a user
echo "👤 Creating a User:\n";
try {
    $customerRole = Role::where('name', 'customer')->first();
    if (!$customerRole) {
        echo "❌ Customer role not found!\n";
        exit;
    }
    
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john.doe' . time() . '@example.com',
        'password' => Hash::make('password123'),
        'address' => '123 Main Street',
        'mobile_number' => '+1234567890',
        'role_id' => $customerRole->id
    ]);
    
    echo "✅ User created successfully!\n";
    echo "   ID: {$user->id}\n";
    echo "   Name: {$user->name}\n";
    echo "   Email: {$user->email}\n";
    echo "   Role: {$user->role->name}\n";
} catch (Exception $e) {
    echo "❌ Error creating user: " . $e->getMessage() . "\n";
}

echo "\n";

// 3. Create a business user and business
echo "🏢 Creating Business User and Business:\n";
try {
    $businessRole = Role::where('name', 'business')->first();
    
    $businessUser = User::create([
        'name' => 'Jane Smith',
        'email' => 'jane.smith' . time() . '@example.com',
        'password' => Hash::make('password123'),
        'address' => '456 Business Ave',
        'mobile_number' => '+0987654321',
        'role_id' => $businessRole->id
    ]);
    
    $business = Business::create([
        'business_name' => 'Jane\'s Restaurant',
        'business_email' => 'info@janesrestaurant.com',
        'business_address' => '456 Business Ave',
        'phone' => '+0987654321',
        'district' => 'Central',
        'province' => 'Western',
        'category' => 'Restaurant',
        'user_id' => $businessUser->id,
        'is_verified' => false
    ]);
    
    echo "✅ Business user and business created!\n";
    echo "   User ID: {$businessUser->id}\n";
    echo "   Business ID: {$business->businesses_id}\n";
    echo "   Business Name: {$business->business_name}\n";
} catch (Exception $e) {
    echo "❌ Error creating business: " . $e->getMessage() . "\n";
}

echo "\n";

// 4. Create a post
echo "📝 Creating a Post:\n";
try {
    if (isset($business)) {
        $post = Post::create([
            'user_id' => $businessUser->id,
            'business_id' => $business->businesses_id,
            'title' => 'Special Weekend Offer!',
            'content' => 'Get 20% off on all menu items this weekend. Visit us and enjoy delicious food at great prices!',
            'post_type' => 'promotion',
            'status' => 'active',
            'privacy_level' => 'public'
        ]);
        
        echo "✅ Post created successfully!\n";
        echo "   Post ID: {$post->id}\n";
        echo "   Title: {$post->title}\n";
    }
} catch (Exception $e) {
    echo "❌ Error creating post: " . $e->getMessage() . "\n";
}

echo "\n";

// 5. Show summary
echo "📊 Database Summary:\n";
echo "Total Users: " . User::count() . "\n";
echo "Total Businesses: " . Business::count() . "\n";
echo "Total Posts: " . Post::count() . "\n";
echo "Total Roles: " . Role::count() . "\n";

echo "\n=== OPERATIONS COMPLETED ===\n";
