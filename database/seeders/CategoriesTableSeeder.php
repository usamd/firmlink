<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Restaurants', 'icon' => 'utensils'],
            ['name' => 'Cafes', 'icon' => 'coffee'],
            ['name' => 'Bars & Pubs', 'icon' => 'beer'],
            ['name' => 'Hotels', 'icon' => 'hotel'],
            ['name' => 'Shopping', 'icon' => 'shopping-bag'],
            ['name' => 'Beauty & Spas', 'icon' => 'spa'],
            ['name' => 'Health & Medical', 'icon' => 'heartbeat'],
            ['name' => 'Automotive', 'icon' => 'car'],
            ['name' => 'Home Services', 'icon' => 'home'],
            ['name' => 'Professional Services', 'icon' => 'briefcase'],
            ['name' => 'Education', 'icon' => 'graduation-cap'],
            ['name' => 'Entertainment', 'icon' => 'film'],
            ['name' => 'Sports & Fitness', 'icon' => 'dumbbell'],
            ['name' => 'Real Estate', 'icon' => 'building'],
            ['name' => 'Technology', 'icon' => 'laptop-code'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $category['icon'],
                'description' => 'Find the best ' . strtolower($category['name']) . ' in your area.',
                'is_active' => true,
                'sort_order' => 0,
            ]);
        }
    }
}
