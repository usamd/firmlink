<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;

echo "=== FIXING ADMIN LOGIN ===\n\n";

// Fix admin email verification
echo "🔧 Fixing admin@email.com email verification:\n";
$admin = User::where('email', 'admin@email.com')->first();

if ($admin) {
    if (!$admin->email_verified_at) {
        $admin->email_verified_at = now();
        $admin->save();
        echo "✅ Email verified for admin@email.com\n";
    } else {
        echo "ℹ️ Email already verified\n";
    }
    
    echo "Updated email_verified_at: {$admin->email_verified_at}\n";
    
    // Test admin login
    echo "\n🧪 Testing admin login:\n";
    if (Auth::attempt(['email' => 'admin@email.com', 'password' => 'password123'])) {
        echo "✅ Admin login successful!\n";
        Auth::logout();
    } else {
        echo "❌ Admin login still failed\n";
    }
} else {
    echo "❌ Admin user not found\n";
}

echo "\n=== ADMIN LOGIN FIXED ===\n";
