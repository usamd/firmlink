<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;

echo "=== RECENT USERS ===\n";
$users = User::latest()->take(5)->get();

foreach ($users as $user) {
    echo "ID: {$user->id} | Name: {$user->name} | Email: {$user->email} | Role: {$user->role->name}\n";
}

echo "\nTotal Users: " . User::count() . "\n";
