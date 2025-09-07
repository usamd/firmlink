<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            // Add missing columns
            if (!Schema::hasColumn('businesses', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('user_id');
            }
            if (!Schema::hasColumn('businesses', 'status')) {
                $table->string('status', 20)->default('pending')->after('is_verified');
            }
            if (!Schema::hasColumn('businesses', 'business_reg_no')) {
                $table->string('business_reg_no')->nullable()->after('status');
            }
            if (!Schema::hasColumn('businesses', 'business_type')) {
                $table->enum('business_type', ['wholesale', 'retail', 'both'])->default('retail')->after('business_reg_no');
            }
            // Ensure category_id exists and is a foreign key
            if (!Schema::hasColumn('businesses', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('business_type');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            }
            // Add any other missing fields here
        });
    }

    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $columnsToDrop = [];
            
            if (Schema::hasColumn('businesses', 'is_verified')) {
                $columnsToDrop[] = 'is_verified';
            }
            if (Schema::hasColumn('businesses', 'status')) {
                $columnsToDrop[] = 'status';
            }
            if (Schema::hasColumn('businesses', 'business_reg_no')) {
                $columnsToDrop[] = 'business_reg_no';
            }
            if (Schema::hasColumn('businesses', 'business_type')) {
                $columnsToDrop[] = 'business_type';
            }
            
            if (count($columnsToDrop) > 0) {
                $table->dropColumn($columnsToDrop);
            }
            
            // Drop foreign key constraint if it exists
            if (Schema::hasColumn('businesses', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};
