<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Facades\Hash;

echo "=== SOLUTION FOR 'ATTEMPT TO READ PROPERTY ID ON NULL' ===\n\n";

echo "🔧 PROBLEM IDENTIFIED:\n";
echo "The User model had 'protected \$with = ['role', 'business'];' which tried to load\n";
echo "the 'business' relationship automatically. Since many users (customers) don't\n";
echo "have businesses, this caused null errors when accessing \$user->business->id\n\n";

echo "✅ SOLUTION APPLIED:\n";
echo "Changed 'protected \$with = ['role', 'business'];' to 'protected \$with = ['role'];'\n";
echo "This removes the automatic loading of the business relationship.\n\n";

echo "📝 BEST PRACTICES TO AVOID THIS ERROR:\n\n";

echo "1. ALWAYS CHECK FOR NULL BEFORE ACCESSING PROPERTIES:\n";
echo "   ❌ Wrong: \$user->business->id\n";
echo "   ✅ Right: \$user->business ? \$user->business->id : null\n\n";

echo "2. USE OPTIONAL() HELPER (Laravel 8+):\n";
echo "   ✅ \$businessId = optional(\$user->business)->id\n\n";

echo "3. USE NULL COALESCING OPERATOR:\n";
echo "   ✅ \$businessId = \$user->business->id ?? null\n\n";

echo "4. LOAD RELATIONSHIPS ONLY WHEN NEEDED:\n";
echo "   ✅ \$user = User::with('business')->find(\$id);\n";
echo "   ✅ \$user->load('business'); // Load after getting user\n\n";

echo "🧪 TESTING SAFE ACCESS PATTERNS:\n\n";

// Create test user
$user = User::create([
    'name' => 'Safe Test User',
    'email' => 'safe' . time() . '@example.com',
    'password' => Hash::make('password123'),
    'role_id' => 3
]);

echo "Created user: {$user->name} (ID: {$user->id})\n\n";

// Safe access patterns
echo "Safe access examples:\n";

// Method 1: Ternary check
$businessId = $user->business ? $user->business->id : null;
echo "1. Ternary: " . ($businessId ?? 'null') . "\n";

// Method 2: optional() helper
$businessId = optional($user->business)->id;
echo "2. optional(): " . ($businessId ?? 'null') . "\n";

// Method 3: Null coalescing
$businessId = $user->business->id ?? null;
echo "3. Null coalescing: " . ($businessId ?? 'null') . "\n";

// Method 4: Safe method call
$businessId = $user->getRelation('business')?->id;
echo "4. Safe method: " . ($businessId ?? 'null') . "\n";

echo "\n🎯 RECOMMENDED APPROACH FOR YOUR CODE:\n\n";

echo "// In controllers or views:\n";
echo "if (\$user->business && \$user->business->id) {\n";
echo "    // Safe to use \$user->business->id\n";
echo "    \$businessId = \$user->business->id;\n";
echo "} else {\n";
echo "    \$businessId = null; // Handle no business case\n";
echo "}\n\n";

echo "// Or using optional():\n";
echo "\$businessId = optional(\$user->business)->id;\n\n";

echo "// For role access (now safe since role is always loaded):\n";
echo "\$roleId = \$user->role ? \$user->role->id : null;\n";
echo "// Or simply: \$roleId = \$user->role->id; // Role should always exist\n\n";

echo "=== SOLUTION COMPLETE ===\n";
