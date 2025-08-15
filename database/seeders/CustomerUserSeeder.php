<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get customer role
        $customerRole = Role::where('name', 'customer')->first();
        
        if (!$customerRole) {
            $this->command->error('Customer role not found! Please run RoleSeeder first.');
            return;
        }

        // Create sample customer users
        $customers = [
            [
                'name' => 'John Customer',
                'email' => 'customer@biznest.com',
                'password' => Hash::make('customer123'),
                'address' => '123 Customer Street, Colombo',
                'nearest_city' => 'Colombo',
                'mobile_number' => '0771234567',
                'id_number' => 'CUST001',
            ],
            [
                'name' => 'Sarah Wilson',
                'email' => 'sarah@example.com',
                'password' => Hash::make('customer123'),
                'address' => '456 Main Road, Kandy',
                'nearest_city' => 'Kandy',
                'mobile_number' => '0772345678',
                'id_number' => 'CUST002',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'password' => Hash::make('customer123'),
                'address' => '789 Lake View, Galle',
                'nearest_city' => 'Galle',
                'mobile_number' => '0773456789',
                'id_number' => 'CUST003',
            ]
        ];

        foreach ($customers as $customerData) {
            // Check if customer already exists
            $existingCustomer = User::where('email', $customerData['email'])->first();
            
            if ($existingCustomer) {
                // Update existing customer to have correct role
                $existingCustomer->update([
                    'role_id' => $customerRole->id,
                    'is_active' => true
                ]);
                $this->command->info('Updated existing customer: ' . $customerData['email']);
            } else {
                // Create new customer
                User::create(array_merge($customerData, [
                    'role_id' => $customerRole->id,
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]));
                $this->command->info('Created customer: ' . $customerData['email']);
            }
        }

        $this->command->info('Customer users setup complete!');
        $this->command->info('Sample Login Credentials:');
        $this->command->info('Email: customer@biznest.com | Password: customer123');
        $this->command->info('Email: sarah@example.com | Password: customer123');
        $this->command->info('Email: mike@example.com | Password: customer123');
    }
}
