<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;

echo "=== FIXING LOGIN ISSUE ===\n\n";

// Fix customer user email verification
echo "🔧 Fixing customer@example.com email verification:\n";
$customer = User::where('email', 'customer@example.com')->first();

if ($customer) {
    if (!$customer->email_verified_at) {
        $customer->email_verified_at = now();
        $customer->save();
        echo "✅ Email verified for customer@example.com\n";
    } else {
        echo "ℹ️ Email already verified\n";
    }
    
    echo "Updated email_verified_at: {$customer->email_verified_at}\n";
} else {
    echo "❌ Customer user not found\n";
}

// Also fix business user
echo "\n🔧 Fixing business@example.com email verification:\n";
$businessUser = User::where('email', 'business@example.com')->first();

if ($businessUser) {
    if (!$businessUser->email_verified_at) {
        $businessUser->email_verified_at = now();
        $businessUser->save();
        echo "✅ Email verified for business@example.com\n";
    } else {
        echo "ℹ️ Email already verified\n";
    }
    
    echo "Updated email_verified_at: {$businessUser->email_verified_at}\n";
} else {
    echo "❌ Business user not found\n";
}

echo "\n🧪 Testing login after fix:\n";

// Test customer login
if ($customer) {
    if (Auth::attempt(['email' => 'customer@example.com', 'password' => 'password123'])) {
        echo "✅ Customer login successful!\n";
        Auth::logout();
    } else {
        echo "❌ Customer login still failed\n";
    }
}

// Test business login
if ($businessUser) {
    if (Auth::attempt(['email' => 'business@example.com', 'password' => 'password123'])) {
        echo "✅ Business login successful!\n";
        Auth::logout();
    } else {
        echo "❌ Business login still failed\n";
    }
}

echo "\n📋 Updated User Status:\n";
$users = User::whereIn('email', ['customer@example.com', 'business@example.com'])->get();
foreach ($users as $user) {
    echo "- {$user->email}: Verified " . ($user->email_verified_at ? 'Yes' : 'No') . ", Active " . ($user->is_active ? 'Yes' : 'No') . "\n";
}

echo "\n=== LOGIN ISSUE FIXED ===\n";
