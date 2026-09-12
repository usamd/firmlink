<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== TESTING FIX FOR NULL ID ERROR ===\n\n";

// Test creating a fresh user with the fixed model
echo "🧪 Creating fresh user with fixed model:\n";
try {
    $user = User::create([
        'name' => 'Fixed Test User',
        'email' => 'fixed' . time() . '@example.com',
        'password' => Hash::make('password123'),
        'role_id' => 3
    ]);
    
    echo "✅ User created: ID {$user->id}\n";
    echo "✅ Role accessible: " . ($user->role ? $user->role->name : 'NULL') . "\n";
    echo "✅ Business accessible: " . ($user->business ? $user->business->business_name : 'NULL') . "\n";
    
    // Test accessing role ID safely
    if ($user->role && $user->role->id) {
        echo "✅ Role ID accessible: {$user->role->id}\n";
    } else {
        echo "❌ Cannot access role ID\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "This is the 'Attempt to read property id on null' error!\n";
}

echo "\n";

// Test with business user
echo "🧪 Creating business user with fixed model:\n";
try {
    $businessUser = User::create([
        'name' => 'Fixed Business User',
        'email' => 'bizfixed' . time() . '@example.com',
        'password' => Hash::make('password123'),
        'role_id' => 2
    ]);
    
    echo "✅ Business user created: ID {$businessUser->id}\n";
    echo "✅ Role accessible: " . ($businessUser->role ? $businessUser->role->name : 'NULL') . "\n";
    echo "✅ Business accessible: " . ($businessUser->business ? $businessUser->business->business_name : 'NULL') . "\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== FIX VERIFICATION COMPLETE ===\n";
