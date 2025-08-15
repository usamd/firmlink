<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Add additional role fields
            $table->string('display_name')->after('name');
            $table->text('description')->nullable()->after('display_name');
            $table->json('permissions')->nullable()->after('description');
            $table->boolean('is_active')->default(true)->after('permissions');
            
            // Add indexes for better performance
            $table->index('name');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop indexes first
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active']);
            
            // Drop columns
            $table->dropColumn([
                'display_name',
                'description',
                'permissions',
                'is_active'
            ]);
        });
    }
};
