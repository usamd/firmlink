<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Business extends Model
{
    use HasFactory;

    protected $primaryKey = 'businesses_id';

    protected $fillable = [
        'business_name', 
        'business_email', 
        'business_address', 
        'phone',
        'district', 
        'postal', 
        'category', 
        'province', 
        'user_id',
        'business_type',
        'location',
        'description',
        'website',
        'is_verified',
        'verified_at'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the business
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the business
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the reviews for the business
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the average rating of the business
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    /**
     * Get the number of reviews for the business
     */
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    /**
     * Scope a query to search businesses
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function($q) use ($searchTerm) {
            $q->where('business_name', 'like', "%{$searchTerm}%")
              ->orWhere('description', 'like', "%{$searchTerm}%");
        });
    }

    /**
     * Scope a query to filter by location
     */
    public function scopeLocation($query, $location)
    {
        return $query->where(function($q) use ($location) {
            $q->where('city', 'like', "%{$location}%")
              ->orWhere('district', 'like', "%{$location}%")
              ->orWhere('province', 'like', "%{$location}%");
        });
    }

    /**
     * Scope a query to filter by category
     */
    public function scopeCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to filter by minimum rating
     */
    public function scopeMinRating($query, $rating)
    {
        return $query->whereHas('reviews', function($q) use ($rating) {
            $q->select(DB::raw('AVG(rating) as avg_rating'))
              ->groupBy('business_id')
              ->having('avg_rating', '>=', $rating);
        });
    }

    /**
     * Get posts for this business
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'business_id', 'businesses_id');
    }

    /**
     * Get followers of this business (polymorphic)
     */
    public function followers()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    /**
     * Scope for verified businesses
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope for pending verification
     */
    public function scopePending($query)
    {
        return $query->where('is_verified', false);
    }

    /**
     * Check if business is verified
     */
    public function isVerified()
    {
        return $this->is_verified;
    }

    /**
     * Get verification status badge
     */
    public function getVerificationStatusAttribute()
    {
        return $this->is_verified ? 'Verified' : 'Pending';
    }

    /**
     * Get business age in days
     */
    public function getAgeInDaysAttribute()
    {
        return $this->created_at->diffInDays(Carbon::now());
    }
}
