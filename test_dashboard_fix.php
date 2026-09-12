<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

echo "=== TESTING DASHBOARD CONTROLLER FIX ===\n\n";

// Test customer login and dashboard access
echo "🧪 Testing Customer Dashboard Access:\n";

// Simulate customer login
$customer = \App\Models\User::where('email', 'customer@example.com')->first();
if ($customer) {
    Auth::login($customer);
    echo "✅ Customer logged in: {$customer->name}\n";
    
    // Test dashboard controller
    $controller = new DashboardController();
    
    try {
        // Test index method
        echo "Testing dashboard index method...\n";
        
        // Create a mock request
        $request = new \Illuminate\Http\Request();
        
        // Call the index method
        $response = $controller->index($request);
        
        if ($response) {
            echo "✅ Dashboard index method executed successfully\n";
        } else {
            echo "❌ Dashboard index method failed\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Error in dashboard: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
    
    Auth::logout();
    echo "✅ Customer logged out\n";
} else {
    echo "❌ Customer user not found\n";
}

echo "\n";

// Test admin login and dashboard access
echo "🧪 Testing Admin Dashboard Access:\n";

$admin = \App\Models\User::where('email', 'admin@email.com')->first();
if ($admin) {
    Auth::login($admin);
    echo "✅ Admin logged in: {$admin->name}\n";
    
    $controller = new DashboardController();
    
    try {
        $request = new \Illuminate\Http\Request();
        $response = $controller->index($request);
        
        if ($response) {
            echo "✅ Admin dashboard index method executed successfully\n";
        } else {
            echo "❌ Admin dashboard index method failed\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Error in admin dashboard: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
    
    Auth::logout();
    echo "✅ Admin logged out\n";
} else {
    echo "❌ Admin user not found\n";
}

echo "\n=== DASHBOARD FIX TEST COMPLETE ===\n";
