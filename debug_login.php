<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== DEBUGGING LOGIN ISSUE ===\n\n";

// Check if customer user exists
echo "🔍 Checking customer@example.com:\n";
$user = User::where('email', 'customer@example.com')->first();

if ($user) {
    echo "✅ User found:\n";
    echo "   ID: {$user->id}\n";
    echo "   Name: {$user->name}\n";
    echo "   Email: {$user->email}\n";
    echo "   Role ID: {$user->role_id}\n";
    echo "   Role: " . ($user->role ? $user->role->name : 'No Role') . "\n";
    echo "   Active: " . ($user->is_active ? 'Yes' : 'No') . "\n";
    echo "   Email Verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n";
    echo "   Created: {$user->created_at}\n";
    
    // Test password verification
    echo "\n🔐 Testing password verification:\n";
    $passwords = ['password123', 'password', '123456', 'admin123'];
    
    foreach ($passwords as $password) {
        if (Hash::check($password, $user->password)) {
            echo "✅ Password '{$password}' matches!\n";
        } else {
            echo "❌ Password '{$password}' does not match\n";
        }
    }
    
    // Check if user can be authenticated
    echo "\n🔑 Testing authentication:\n";
    if (Auth::attempt(['email' => 'customer@example.com', 'password' => 'password123'])) {
        echo "✅ Authentication successful!\n";
        Auth::logout(); // Logout after test
    } else {
        echo "❌ Authentication failed!\n";
    }
    
} else {
    echo "❌ User customer@example.com not found!\n";
    
    // Show all users for debugging
    echo "\n📋 All users in database:\n";
    $users = User::all();
    foreach ($users as $u) {
        echo "   - {$u->email} (ID: {$u->id}, Role: " . ($u->role ? $u->role->name : 'No Role') . ")\n";
    }
}

echo "\n=== DEBUG COMPLETE ===\n";
