<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BusinessUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get business role
        $businessRole = Role::where('name', 'business')->first();
        
        if (!$businessRole) {
            $this->command->error('Business role not found! Please run RoleSeeder first.');
            return;
        }

        // Create sample business users with their businesses
        $businessData = [
            [
                'user' => [
                    'name' => 'Restaurant Owner',
                    'email' => 'business@biznest.com',
                    'password' => Hash::make('business123'),
                    'address' => '100 Business Avenue, Colombo',
                    'nearest_city' => 'Colombo',
                    'mobile_number' => '0711234567',
                    'id_number' => 'BIZ001',
                ],
                'business' => [
                    'business_name' => 'Golden Spoon Restaurant',
                    'business_email' => 'info@goldenspoon.lk',
                    'business_address' => '100 Business Avenue, Colombo 03',
                    'phone' => '0711234567',
                    'district' => 'Colombo',
                    'postal' => '00300',
                    'category' => 'Restaurant',
                    'province' => 'Western',
                ]
            ],
            [
                'user' => [
                    'name' => 'Tech Startup CEO',
                    'email' => 'tech@biznest.com',
                    'password' => Hash::make('business123'),
                    'address' => '200 Tech Park, Kandy',
                    'nearest_city' => 'Kandy',
                    'mobile_number' => '0712345678',
                    'id_number' => 'BIZ002',
                ],
                'business' => [
                    'business_name' => 'InnovateLK Solutions',
                    'business_email' => 'contact@innovatelk.com',
                    'business_address' => '200 Tech Park, Kandy',
                    'phone' => '0712345678',
                    'district' => 'Kandy',
                    'postal' => '20000',
                    'category' => 'Technology',
                    'province' => 'Central',
                ]
            ],
            [
                'user' => [
                    'name' => 'Fashion Designer',
                    'email' => 'fashion@biznest.com',
                    'password' => Hash::make('business123'),
                    'address' => '300 Fashion Street, Galle',
                    'nearest_city' => 'Galle',
                    'mobile_number' => '0713456789',
                    'id_number' => 'BIZ003',
                ],
                'business' => [
                    'business_name' => 'Elegant Designs',
                    'business_email' => 'hello@elegantdesigns.lk',
                    'business_address' => '300 Fashion Street, Galle',
                    'phone' => '0713456789',
                    'district' => 'Galle',
                    'postal' => '80000',
                    'category' => 'Fashion',
                    'province' => 'Southern',
                ]
            ]
        ];

        foreach ($businessData as $data) {
            // Check if business user already exists
            $existingUser = User::where('email', $data['user']['email'])->first();
            
            if ($existingUser) {
                // Update existing user to have business role
                $existingUser->update([
                    'role_id' => $businessRole->id,
                    'is_active' => true
                ]);
                $user = $existingUser;
                $this->command->info('Updated existing business user: ' . $data['user']['email']);
            } else {
                // Create new business user
                $user = User::create(array_merge($data['user'], [
                    'role_id' => $businessRole->id,
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]));
                $this->command->info('Created business user: ' . $data['user']['email']);
            }

            // Create or update business profile
            $existingBusiness = Business::where('user_id', $user->id)->first();
            
            if ($existingBusiness) {
                $existingBusiness->update($data['business']);
                $this->command->info('Updated business profile: ' . $data['business']['business_name']);
            } else {
                Business::create(array_merge($data['business'], [
                    'user_id' => $user->id,
                ]));
                $this->command->info('Created business profile: ' . $data['business']['business_name']);
            }
        }

        $this->command->info('Business users setup complete!');
        $this->command->info('Sample Login Credentials:');
        $this->command->info('Email: business@biznest.com | Password: business123 | Business: Golden Spoon Restaurant');
        $this->command->info('Email: tech@biznest.com | Password: business123 | Business: InnovateLK Solutions');
        $this->command->info('Email: fashion@biznest.com | Password: business123 | Business: Elegant Designs');
    }
}
