<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;

echo "=== COMPLETE LOGIN TEST ===\n\n";

echo "🔑 Testing all user accounts:\n\n";

$testAccounts = [
    'customer@example.com' => 'password123',
    'business@example.com' => 'password123',
    'admin@email.com' => 'password123'
];

foreach ($testAccounts as $email => $password) {
    echo "Testing {$email}:\n";
    
    $user = User::where('email', $email)->first();
    
    if ($user) {
        echo "  ✅ User found: {$user->name} (ID: {$user->id})\n";
        echo "  📧 Email verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n";
        echo "  🔄 Active: " . ($user->is_active ? 'Yes' : 'No') . "\n";
        echo "  👤 Role: " . ($user->role ? $user->role->name : 'No Role') . "\n";
        
        // Test login
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            echo "  ✅ Login successful!\n";
            
            // Test redirect based on role
            if ($user->hasRole('admin')) {
                echo "  🎯 Would redirect to: /admin/dashboard\n";
            } elseif ($user->hasRole('business')) {
                echo "  🎯 Would redirect to: /business/dashboard\n";
            } else {
                echo "  🎯 Would redirect to: /user/dashboard\n";
            }
            
            Auth::logout();
        } else {
            echo "  ❌ Login failed!\n";
        }
    } else {
        echo "  ❌ User not found!\n";
    }
    
    echo "\n";
}

echo "🌐 Access Information:\n";
echo "Customer Dashboard: http://localhost/user/dashboard\n";
echo "Business Dashboard: http://localhost/business/dashboard\n";
echo "Admin Dashboard: http://localhost/admin/dashboard\n\n";

echo "📝 Login Credentials:\n";
echo "Customer: customer@example.com / password123\n";
echo "Business: business@example.com / password123\n";
echo "Admin: admin@email.com / password123\n\n";

echo "=== LOGIN TEST COMPLETE ===\n";
