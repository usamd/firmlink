<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

echo "=== DEBUGGING USER CREATION ===\n\n";

// 1. Check if roles exist
echo "📋 Checking available roles:\n";
$roles = Role::all();
foreach ($roles as $role) {
    echo "- ID: {$role->id}, Name: {$role->name}\n";
}

if ($roles->isEmpty()) {
    echo "❌ No roles found! This is likely the problem.\n";
    exit;
}

// 2. Try to get a specific role
echo "\n🎯 Getting role with ID 3:\n";
$role = Role::find(3);
if ($role) {
    echo "✅ Role found: {$role->name}\n";
} else {
    echo "❌ Role with ID 3 not found!\n";
    echo "Available role IDs: " . $roles->pluck('id')->implode(', ') . "\n";
    exit;
}

// 3. Try to create user without automatic relationship loading
echo "\n👤 Creating user (without automatic relationships):\n";

// Temporarily disable the $with property
$userModel = new User();
$userModel->with = []; // Disable automatic loading

try {
    $user = $userModel->create([
        'name' => 'Debug User',
        'email' => 'debug' . time() . '@example.com',
        'password' => Hash::make('password123'),
        'role_id' => 3
    ]);
    
    echo "✅ User created successfully!\n";
    echo "ID: {$user->id}\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Role ID: {$user->role_id}\n";
    
    // 4. Try to load the relationship manually
    echo "\n🔗 Loading role relationship manually:\n";
    $role = $user->role;
    if ($role) {
        echo "✅ Role loaded: {$role->name}\n";
    } else {
        echo "❌ Role relationship failed to load!\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error creating user: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== DEBUG COMPLETE ===\n";
