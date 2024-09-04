<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product')->insert([
            [
                'product_name' => 'Laptop',
                'location' => 'Warehouse A',
                'quantity' => 5,
                'businesses_id' => 1, // Assuming the business with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Smartphone',
                'location' => 'Warehouse B',
                'quantity' => 20,
                'businesses_id' => 1, // Assuming the business with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Tablet',
                'location' => 'Warehouse C',
                'quantity' => 16,
                'businesses_id' => 1, // Assuming the business with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
