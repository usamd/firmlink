<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use App\Models\Business;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

echo "=== SETTING UP ROLES AND SAMPLE DATA ===\n\n";

// 1. Create missing roles
echo "🔧 Setting up roles:\n";
$roles = [
    ['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'Full system access'],
    ['name' => 'business', 'display_name' => 'Business Owner', 'description' => 'Can manage businesses'],
    ['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Regular user']
];

foreach ($roles as $roleData) {
    $role = Role::firstOrCreate(['name' => $roleData['name']], $roleData);
    echo "✅ Role '{$role->name}' (ID: {$role->id}) - {$role->display_name}\n";
}

echo "\n";

// 2. Create sample users
echo "👥 Creating sample users:\n";

// Customer user
$customerRole = Role::where('name', 'customer')->first();
$customer = User::firstOrCreate(
    ['email' => 'customer@example.com'],
    [
        'name' => 'Customer User',
        'password' => Hash::make('password123'),
        'address' => '123 Customer St',
        'mobile_number' => '+1111111111',
        'role_id' => $customerRole->id
    ]
);
echo "✅ Customer: {$customer->name} ({$customer->email})\n";

// Business user
$businessRole = Role::where('name', 'business')->first();
$businessUser = User::firstOrCreate(
    ['email' => 'business@example.com'],
    [
        'name' => 'Business Owner',
        'password' => Hash::make('password123'),
        'address' => '456 Business Ave',
        'mobile_number' => '+2222222222',
        'role_id' => $businessRole->id
    ]
);
echo "✅ Business Owner: {$businessUser->name} ({$businessUser->email})\n";

echo "\n";

// 3. Create sample business
echo "🏢 Creating sample business:\n";
$business = Business::firstOrCreate(
    ['business_email' => 'info@samplebusiness.com'],
    [
        'business_name' => 'Sample Restaurant',
        'business_address' => '456 Business Ave',
        'phone' => '+2222222222',
        'district' => 'Central',
        'province' => 'Western',
        'postal' => '00100',
        'category' => 'Restaurant',
        'user_id' => $businessUser->id,
        'description' => 'A wonderful place to eat!',
        'is_verified' => false
    ]
);
echo "✅ Business: {$business->business_name} (ID: {$business->businesses_id})\n";

echo "\n";

// 4. Create sample post
echo "📝 Creating sample post:\n";
$post = Post::firstOrCreate(
    ['title' => 'Welcome to Our Restaurant!'],
    [
        'user_id' => $businessUser->id,
        'business_id' => $business->businesses_id,
        'content' => 'We are excited to serve you the best food in town!',
        'post_type' => 'promotion',
        'status' => 'active',
        'privacy_level' => 'public'
    ]
);
echo "✅ Post: {$post->title} (ID: {$post->id})\n";

echo "\n=== LOGIN CREDENTIALS ===\n";
echo "Customer: customer@example.com / password123\n";
echo "Business: business@example.com / password123\n";
echo "\n=== SETUP COMPLETE ===\n";
