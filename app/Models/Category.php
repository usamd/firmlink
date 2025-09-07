<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the businesses for the category.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class, 'category_id');
    }

    /**
     * Get the icon class for the category.
     */
    public function getIconClassAttribute()
    {
        $iconMap = [
            'restaurant' => 'utensils',
            'food' => 'utensils',
            'cafe' => 'coffee',
            'shop' => 'shopping-bag',
            'store' => 'store',
            'retail' => 'shopping-basket',
            'health' => 'heartbeat',
            'healthcare' => 'heartbeat',
            'medical' => 'hospital',
            'education' => 'graduation-cap',
            'school' => 'school',
            'service' => 'tools',
            'services' => 'tools',
            'automotive' => 'car',
            'car' => 'car',
            'beauty' => 'spa',
            'spa' => 'spa',
            'hotel' => 'hotel',
            'travel' => 'plane',
            'home' => 'home',
            'real-estate' => 'building',
            'technology' => 'laptop',
            'it' => 'laptop',
            'finance' => 'money-bill-wave',
            'bank' => 'university',
            'entertainment' => 'film',
            'sports' => 'futbol',
            'fitness' => 'dumbbell',
            'gym' => 'dumbbell',
            'transport' => 'bus',
            'logistics' => 'truck',
        ];

        // Try to find a matching icon in the name or slug
        $name = strtolower($this->name);
        $slug = strtolower($this->slug);

        foreach ($iconMap as $key => $icon) {
            if (str_contains($name, $key) || str_contains($slug, $key)) {
                return 'fa-' . $icon;
            }
        }

        // Default icon
        return 'fa-tag';
    }
}
