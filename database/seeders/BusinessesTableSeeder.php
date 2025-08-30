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
                'business_email' => 'tech@techsolutions.com',
                'business_address' => '123 Tech Park, Colombo 03',
                'phone' => '0112345678',
                'district' => 'Colombo',
                'postal' => '00300',
                'category' => 'Technology',
                'province' => 'Western',
                'description' => 'Leading technology solutions provider in Sri Lanka',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Creative Designs Co.',
                'business_email' => 'info@creativedesigns.lk',
                'business_address' => '456 Design Street, Kandy',
                'phone' => '0812345678',
                'district' => 'Kandy',
                'postal' => '20000',
                'category' => 'Design',
                'province' => 'Central',
                'description' => 'Creative design solutions for your business needs',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'business_name' => 'Global Logistics',
                'business_email' => 'contact@globallogistics.lk',
                'business_address' => '789 Logistics Hub, Galle',
                'phone' => '0912345678',
                'district' => 'Galle',
                'postal' => '80000',
                'category' => 'Logistics',
                'province' => 'Southern',
                'description' => 'Your trusted logistics partner for all shipping needs',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
