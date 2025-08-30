<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // CRITICAL: Run RoleSeeder FIRST - all users need roles to exist
        $this->call(RoleSeeder::class);
        
        // Then seed all user types with proper roles
        $this->call(AdminUserSeeder::class);
        $this->call(CustomerUserSeeder::class);
        $this->call(BusinessUserSeeder::class);
        
        // Legacy user seeder (if needed)
        $this->call(UserSeeder::class);
        
        // Other data seeders
        $this->call(BusinessesTableSeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        
        $this->command->info('🎉 All seeders completed successfully!');
        $this->command->info('✅ Test Users Created:');
        $this->command->info('   👨‍💼 Admin: admin@biznest.com / admin123');
        $this->command->info('   🏢 Business: business@biznest.com / business123');
        $this->command->info('   👤 Customer: customer@biznest.com / customer123');
    }
}
