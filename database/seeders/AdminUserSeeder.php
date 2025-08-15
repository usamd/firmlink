<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create admin role
        $adminRole = Role::where('name', 'admin')->first();
        
        if (!$adminRole) {
            $this->command->error('Admin role not found! Please run RoleSeeder first.');
            return;
        }

        // Check if admin user already exists
        $adminUser = User::where('email', 'admin@biznest.com')->first();

        if ($adminUser) {
            // Update existing user to have admin role
            $adminUser->update([
                'role_id' => $adminRole->id,
                'is_active' => true
            ]);
            $this->command->info('Updated existing admin user with admin role.');
        } else {
            // Create new admin user
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@biznest.com',
                'password' => Hash::make('admin123'),
                'address' => 'Admin Address',
                'nearest_city' => 'Admin City',
                'mobile_number' => '1234567890',
                'id_number' => 'ADMIN001',
                'role_id' => $adminRole->id,
                'is_active' => true,
                'email_verified_at' => now(),
                'last_login_at' => now()
            ]);
            $this->command->info('Created new admin user.');
        }

        $this->command->info('Admin user setup complete!');
        $this->command->info('Email: admin@biznest.com');
        $this->command->info('Password: admin123');
        $this->command->info('Role: Admin (ID: ' . $adminRole->id . ')');
    }
}
