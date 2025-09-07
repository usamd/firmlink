<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Retail', 'slug' => 'retail', 'description' => 'Retail businesses selling products directly to consumers'],
            ['name' => 'Wholesale', 'slug' => 'wholesale', 'description' => 'Businesses that sell products in bulk to retailers'],
            ['name' => 'Food & Beverage', 'slug' => 'food-beverage', 'description' => 'Restaurants, cafes, and food service businesses'],
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Tech companies and IT services'],
            ['name' => 'Healthcare', 'slug' => 'healthcare', 'description' => 'Medical services and healthcare providers'],
            ['name' => 'Education', 'slug' => 'education', 'description' => 'Educational institutions and services'],
            ['name' => 'Construction', 'slug' => 'construction', 'description' => 'Construction and contracting services'],
            ['name' => 'Manufacturing', 'slug' => 'manufacturing', 'description' => 'Product manufacturing businesses'],
            ['name' => 'Professional Services', 'slug' => 'professional-services', 'description' => 'Legal, accounting, and consulting services'],
            ['name' => 'Hospitality', 'slug' => 'hospitality', 'description' => 'Hotels, travel, and tourism services'],
            ['name' => 'Beauty & Wellness', 'slug' => 'beauty-wellness', 'description' => 'Salons, spas, and wellness services'],
            ['name' => 'Automotive', 'slug' => 'automotive', 'description' => 'Vehicle sales, service, and maintenance'],
            ['name' => 'Real Estate', 'slug' => 'real-estate', 'description' => 'Property sales, rentals, and management'],
            ['name' => 'Financial Services', 'slug' => 'financial-services', 'description' => 'Banking, insurance, and financial planning'],
            ['name' => 'Other', 'slug' => 'other', 'description' => 'Other business categories']
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
