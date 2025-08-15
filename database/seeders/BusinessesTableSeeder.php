<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('businesses')->insert([
            [
                'business_name' => 'Tech Solutions Inc.',
                'user_id' => 1, // Assuming the user with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Creative Designs Co.',
                'user_id' => 2, // Assuming the user with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Global Logistics',
                'user_id' => 3, // Assuming the user with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
