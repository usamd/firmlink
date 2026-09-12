# Terminal Database Operations Guide for Laravel

## 1. Using Artisan Tinker (Interactive)

### Start Tinker
```bash
cd g:\project-biznest
php artisan tinker
```

### Inside Tinker - Create Data
```php
// Create a user
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::create([
    'name' => 'New User',
    'email' => 'newuser@example.com',
    'password' => Hash::make('password123'),
    'role_id' => 3
]);

// Create a business
use App\Models\Business;

$business = Business::create([
    'business_name' => 'New Business',
    'business_email' => 'info@newbusiness.com',
    'business_address' => '123 New St',
    'phone' => '+1234567890',
    'district' => 'Central',
    'province' => 'Western',
    'postal' => '00100',
    'category' => 'Restaurant',
    'user_id' => $user->id
]);

// Create a post
use App\Models\Post;

$post = Post::create([
    'user_id' => $user->id,
    'business_id' => $business->businesses_id,
    'title' => 'Special Offer!',
    'content' => 'Get 20% off this weekend',
    'post_type' => 'promotion',
    'status' => 'active'
]);
```

## 2. Using PHP Scripts (Like We Just Did)

### Run the setup script
```bash
cd g:\project-biznest
php setup_roles_and_data.php
```

### Create custom script
```bash
# Create a new file
echo "<?php
require_once __DIR__ . '/vendor/autoload.php';
\$app = require_once __DIR__ . '/bootstrap/app.php';
\$kernel = \$app->make(Illuminate\Contracts\Console\Kernel::class);
\$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Your database operations here
echo 'Database operations completed!';
" > custom_script.php

# Run it
php custom_script.php
```

## 3. Using Artisan Commands

### Create a new custom command
```bash
php artisan make:command CreateSampleData
```

### Run migrations
```bash
php artisan migrate
```

### Seed the database
```bash
php artisan db:seed
```

### Fresh start (migrate + seed)
```bash
php artisan migrate:fresh --seed
```

## 4. Direct SQL Queries

### Using DB facade in a script
```php
use Illuminate\Support\Facades\DB;

// Insert data
DB::table('users')->insert([
    'name' => 'Direct User',
    'email' => 'direct@example.com',
    'password' => Hash::make('password'),
    'role_id' => 3,
    'created_at' => now(),
    'updated_at' => now()
]);

// Query data
$users = DB::table('users')->get();
foreach ($users as $user) {
    echo $user->name . "\n";
}
```

## 5. Quick Terminal Commands

### Check database connection
```bash
php artisan tinker --execute="echo 'Database connected: ' . DB::connection()->getDatabaseName();"
```

### Count records
```bash
php artisan tinker --execute="echo 'Users: ' . App\Models\User::count();"
php artisan tinker --execute="echo 'Businesses: ' . App\Models\Business::count();"
php artisan tinker --execute="echo 'Posts: ' . App\Models\Post::count();"
```

### Create quick user
```bash
php artisan tinker --execute="
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
User::create([
    'name' => 'Quick User', 
    'email' => 'quick' . time() . '@example.com', 
    'password' => Hash::make('password123'),
    'role_id' => 3
]);
echo 'User created!';
"
```

## 6. Database Status Commands

### Check table status
```bash
php artisan tinker --execute="
echo '=== DATABASE STATUS ===' . PHP_EOL;
echo 'Users: ' . App\Models\User::count() . PHP_EOL;
echo 'Businesses: ' . App\Models\Business::count() . PHP_EOL;
echo 'Posts: ' . App\Models\Post::count() . PHP_EOL;
echo 'Roles: ' . App\Models\Role::count() . PHP_EOL;
"
```

### List recent users
```bash
php artisan tinker --execute="
\$users = App\Models\User::latest()->take(5)->get();
foreach(\$users as \$user) {
    echo \$user->id . ': ' . \$user->name . ' (' . \$user->email . ')' . PHP_EOL;
}
"
```

## 7. File-Based Operations

### The files we created:
- `setup_roles_and_data.php` - Complete setup script
- `database_operations.php` - Operations demo
- `create_test_user.php` - Simple user creation

### Run any of them:
```bash
php setup_roles_and_data.php
php database_operations.php
php create_test_user.php
```

## 8. Environment Setup

### Check .env database settings
```bash
php artisan tinker --execute="
echo 'Database: ' . config('database.default') . PHP_EOL;
echo 'Host: ' . config('database.connections.mysql.host') . PHP_EOL;
echo 'Database: ' . config('database.connections.mysql.database') . PHP_EOL;
"
```

## Tips:
1. Always use `Hash::make()` for passwords
2. Check foreign key constraints before inserting
3. Use transactions for multiple related operations
4. Validate data before inserting
5. Use `firstOrCreate()` to avoid duplicates
