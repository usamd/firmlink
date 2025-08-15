<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'permissions',
        'is_active'
    ];

    protected $casts = [
        'permissions' => 'array',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // Role constants
    const ADMIN = 'admin';
    const BUSINESS = 'business';
    const CUSTOMER = 'customer';

    // Permission constants
    const PERMISSIONS = [
        'admin' => [
            'manage_users',
            'manage_businesses',
            'manage_posts',
            'moderate_content',
            'verify_businesses',
            'access_admin_panel',
            'manage_roles',
            'view_analytics',
            'manage_settings'
        ],
        'business' => [
            'create_business',
            'manage_own_business',
            'create_posts',
            'manage_own_posts',
            'respond_to_messages',
            'view_business_analytics',
            'promote_posts'
        ],
        'customer' => [
            'create_posts',
            'manage_own_posts',
            'follow_users',
            'follow_businesses',
            'send_messages',
            'like_posts',
            'comment_posts',
            'search_businesses'
        ]
    ];

    // Helper methods
    public function isAdmin(): bool
    {
        return $this->name === self::ADMIN;
    }

    public function isBusiness(): bool
    {
        return $this->name === self::BUSINESS;
    }

    public function isCustomer(): bool
    {
        return $this->name === self::CUSTOMER;
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions ?? []);
    }

    public function givePermission(string $permission): void
    {
        $permissions = $this->permissions ?? [];
        if (!in_array($permission, $permissions)) {
            $permissions[] = $permission;
            $this->update(['permissions' => $permissions]);
        }
    }

    public function revokePermission(string $permission): void
    {
        $permissions = $this->permissions ?? [];
        $permissions = array_filter($permissions, fn($p) => $p !== $permission);
        $this->update(['permissions' => array_values($permissions)]);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByName($query, string $name)
    {
        return $query->where('name', $name);
    }

    // Static helper methods
    public static function getAdminRole()
    {
        return static::where('name', self::ADMIN)->first();
    }

    public static function getBusinessRole()
    {
        return static::where('name', self::BUSINESS)->first();
    }

    public static function getCustomerRole()
    {
        return static::where('name', self::CUSTOMER)->first();
    }

    public static function createDefaultRoles()
    {
        $roles = [
            [
                'name' => self::ADMIN,
                'display_name' => 'Administrator',
                'description' => 'Full system access and control',
                'permissions' => self::PERMISSIONS['admin'],
                'is_active' => true
            ],
            [
                'name' => self::BUSINESS,
                'display_name' => 'Business Owner',
                'description' => 'Can manage business profiles and content',
                'permissions' => self::PERMISSIONS['business'],
                'is_active' => true
            ],
            [
                'name' => self::CUSTOMER,
                'display_name' => 'Customer',
                'description' => 'Can browse and interact with businesses',
                'permissions' => self::PERMISSIONS['customer'],
                'is_active' => true
            ]
        ];

        foreach ($roles as $roleData) {
            static::updateOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );
        }
    }
}
