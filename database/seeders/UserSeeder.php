<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create specific users
        User::create([
            'name' => 'Sameera Dilshan',
            'email' => 'sameera@email.com',
            'password' => bcrypt('123456789'),
            'avatar' => 'me.jpg',
        ]);

        User::create([
            'name' => 'Udayanga Sameera',
            'email' => 'udayanga@email.com',
            'password' => bcrypt('123456789'),
            'avatar' => 'me1.jpg',
        ]);

        // Create additional dummy users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatar1.jpg',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatar2.jpg',
        ]);
    }
}
