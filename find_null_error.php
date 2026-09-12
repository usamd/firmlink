<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use App\Models\Business;
use App\Models\Post;
use App\Models\Role;

echo "=== FINDING NULL ID ERROR ===\n\n";

// Test 1: User creation and access
echo "🧪 Test 1: User Creation and Access\n";
try {
    $user = User::create([
        'name' => 'Test User ' . time(),
        'email' => 'test' . time() . '@example.com',
        'password' => Hash::make('password123'),
        'role_id' => 3
    ]);
    
    echo "✅ User created: ID {$user->id}\n";
    
    // Test accessing role
    if ($user->role) {
        echo "✅ Role accessible: {$user->role->name} (ID: {$user->role->id})\n";
    } else {
        echo "❌ Role is null!\n";
    }
    
    // Test accessing business
    if ($user->business) {
        echo "✅ Business accessible: {$user->business->business_name} (ID: {$user->business->businesses_id})\n";
    } else {
        echo "ℹ️ Business is null (normal for customer users)\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n";

// Test 2: Business creation and user access
echo "🧪 Test 2: Business Creation and User Access\n";
try {
    $businessUser = User::create([
        'name' => 'Business User ' . time(),
        'email' => 'business' . time() . '@example.com',
        'password' => Hash::make('password123'),
        'role_id' => 2
    ]);
    
    $business = Business::create([
        'business_name' => 'Test Business',
        'business_email' => 'business' . time() . '@test.com',
        'business_address' => '123 Test St',
        'phone' => '+1234567890',
        'district' => 'Central',
        'province' => 'Western',
        'postal' => '00100',
        'category' => 'Restaurant',
        'user_id' => $businessUser->id
    ]);
    
    echo "✅ Business created: ID {$business->businesses_id}\n";
    
    // Test accessing user from business
    if ($business->user) {
        echo "✅ User accessible: {$business->user->name} (ID: {$business->user->id})\n";
    } else {
        echo "❌ Business user is null!\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n";

// Test 3: Post creation and relationships
echo "🧪 Test 3: Post Creation and Relationships\n";
try {
    if (isset($business)) {
        $post = Post::create([
            'user_id' => $businessUser->id,
            'business_id' => $business->businesses_id,
            'title' => 'Test Post',
            'content' => 'This is a test post',
            'post_type' => 'text',
            'status' => 'active'
        ]);
        
        echo "✅ Post created: ID {$post->id}\n";
        
        // Test accessing user from post
        if ($post->user) {
            echo "✅ Post user accessible: {$post->user->name} (ID: {$post->user->id})\n";
        } else {
            echo "❌ Post user is null!\n";
        }
        
        // Test accessing business from post
        if ($post->business) {
            echo "✅ Post business accessible: {$post->business->business_name} (ID: {$post->business->businesses_id})\n";
        } else {
            echo "❌ Post business is null!\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n";

// Test 4: Check for potential issues in existing data
echo "🧪 Test 4: Check Existing Data\n";
try {
    $users = User::with(['role', 'business'])->get();
    
    foreach ($users as $user) {
        echo "User ID: {$user->id}, Name: {$user->name}\n";
        
        if ($user->role_id && !$user->role) {
            echo "  ❌ Role ID {$user->role_id} exists but role relationship is null!\n";
        }
        
        if ($user->businesses && !$user->business) {
            echo "  ❌ User has businesses but business relationship is null!\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Error checking existing data: " . $e->getMessage() . "\n";
}

echo "\n=== DEBUG COMPLETE ===\n";
