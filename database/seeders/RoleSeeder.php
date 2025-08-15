<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default roles using the Role model's static method
        Role::createDefaultRoles();

        $this->command->info('Default roles created successfully!');
        $this->command->info('- Admin: Full system access and control');
        $this->command->info('- Business: Can manage business profiles and content');
        $this->command->info('- Customer: Can browse and interact with businesses');
    }
}
