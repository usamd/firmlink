<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'followable_id',
        'followable_type',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followable()
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeForFollower($query, $followerId)
    {
        return $query->where('follower_id', $followerId);
    }

    public function scopeForFollowable($query, $followableId, $followableType)
    {
        return $query->where('followable_id', $followableId)
                    ->where('followable_type', $followableType);
    }

    // Methods
    public function accept()
    {
        $this->update(['status' => 'active']);
    }

    public function reject()
    {
        $this->delete();
    }
}
