<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== CHECKING ADMIN PASSWORD ===\n\n";

$admin = User::where('email', 'admin@email.com')->first();

if ($admin) {
    echo "Admin user found:\n";
    echo "ID: {$admin->id}\n";
    echo "Email: {$admin->email}\n";
    echo "Email Verified: " . ($admin->email_verified_at ? 'Yes' : 'No') . "\n";
    
    // Test different passwords
    $passwords = ['password123', 'admin123', 'admin', 'password'];
    
    echo "\nTesting passwords:\n";
    foreach ($passwords as $password) {
        if (Hash::check($password, $admin->password)) {
            echo "✅ '{$password}' - MATCHES!\n";
        } else {
            echo "❌ '{$password}' - No match\n";
        }
    }
    
    // Reset admin password to password123
    echo "\n🔧 Resetting admin password to 'password123':\n";
    $admin->password = Hash::make('password123');
    $admin->save();
    echo "✅ Password reset successfully\n";
    
    // Test login again
    echo "\n🧪 Testing admin login with new password:\n";
    if (Auth::attempt(['email' => 'admin@email.com', 'password' => 'password123'])) {
        echo "✅ Admin login successful!\n";
        Auth::logout();
    } else {
        echo "❌ Admin login still failed\n";
    }
    
} else {
    echo "❌ Admin user not found\n";
}

echo "\n=== ADMIN PASSWORD CHECK COMPLETE ===\n";
