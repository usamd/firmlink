<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'business_id',
        'title',
        'content',
        'image_path',
        'video_path',
        'post_type',
        'status',
        'is_promoted',
        'location',
        'tags',
        'privacy_level',
        'views_count'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_promoted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'businesses_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function shares()
    {
        return $this->hasMany(Share::class);
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('privacy_level', 'public');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePromoted($query)
    {
        return $query->where('is_promoted', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('post_type', $type);
    }

    // Accessors
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function getSharesCountAttribute()
    {
        return $this->shares()->count();
    }

    public function getIsLikedByUserAttribute()
    {
        if (!auth()->check()) {
            return false;
        }
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
