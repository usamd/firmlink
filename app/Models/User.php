<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role_id',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'bio',
        'is_active',
        'email_verified_at',
        'last_login_at'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['role', 'business'];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the business associated with the user.
     */
    public function business()
    {
        return $this->hasOne(Business::class, 'user_id', 'id');
    }

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'user_id');
    }

    /**
     * Get all of the saved businesses for the user.
     */
    public function savedBusinesses()
    {
        return $this->hasMany(SavedBusiness::class);
    }

    // Following relationships
    public function following(): HasMany
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function followers(): MorphMany
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    // Role checking methods
    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function isBusiness(): bool
    {
        return $this->role && $this->role->name === 'business';
    }

    public function isCustomer(): bool
    {
        return $this->role && $this->role->name === 'customer';
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    public function hasAnyRole(array $roleNames): bool
    {
        return $this->role && in_array($this->role->name, $roleNames);
    }

    // Permission checking methods
    public function canManageBusinesses(): bool
    {
        return $this->isAdmin() || $this->isBusiness();
    }

    public function canCreatePosts(): bool
    {
        return $this->isActive() && ($this->isAdmin() || $this->isBusiness() || $this->isCustomer());
    }

    public function canModerateContent(): bool
    {
        return $this->isAdmin();
    }

    public function canVerifyBusinesses(): bool
    {
        return $this->isAdmin();
    }

    public function canAccessAdminPanel(): bool
    {
        return $this->isAdmin();
    }

    // Utility methods
    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getDisplayName(): string
    {
        return $this->name;
    }

    public function getAvatarUrl(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        
        // Generate default avatar with initials
        $initials = strtoupper(substr($this->name, 0, 1));
        return "https://ui-avatars.com/api/?name={$initials}&background=7fb069&color=ffffff&size=200";
    }

    public function getRoleName(): string
    {
        return $this->role ? $this->role->name : 'guest';
    }

    public function getRoleDisplayName(): string
    {
        return $this->role ? $this->role->display_name : 'Guest';
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByRole($query, string $roleName)
    {
        return $query->whereHas('role', function($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    public function scopeAdmins($query)
    {
        return $query->byRole('admin');
    }

    public function scopeBusinessUsers($query)
    {
        return $query->byRole('business');
    }

    public function scopeCustomers($query)
    {
        return $query->byRole('customer');
    }

    // Boot method for model events
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Set default role to customer if not specified
            if (!$user->role_id) {
                $customerRole = Role::where('name', 'customer')->first();
                if ($customerRole) {
                    $user->role_id = $customerRole->id;
                }
            }
        });

        static::updated(function ($user) {
            // Update last login timestamp
            if ($user->isDirty('last_login_at')) {
                $user->timestamps = false;
                $user->save();
                $user->timestamps = true;
            }
        });
    }
}
