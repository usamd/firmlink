<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
        'is_edited',
        'is_deleted',
        'deleted_from_sender',
        'deleted_from_receiver',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_edited' => 'boolean',
        'is_deleted' => 'boolean',
        'deleted_from_sender' => 'boolean',
        'deleted_from_receiver' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sender of the message.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver of the message.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Scope a query to only include messages between two users.
     */
    public function scopeBetweenUsers($query, $firstUserId, $secondUserId)
    {
        return $query->where(function($q) use ($firstUserId, $secondUserId) {
            $q->where('sender_id', $firstUserId)
              ->where('receiver_id', $secondUserId);
        })->orWhere(function($q) use ($firstUserId, $secondUserId) {
            $q->where('sender_id', $secondUserId)
              ->where('receiver_id', $firstUserId);
        });
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(): bool
    {
        if ($this->is_read) {
            return false;
        }

        $this->is_read = true;
        return $this->save();
    }
}
