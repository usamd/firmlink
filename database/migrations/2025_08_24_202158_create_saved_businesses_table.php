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
        Schema::create('saved_businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Use the correct column name for the businesses table
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')
                  ->references('businesses_id')
                  ->on('businesses')
                  ->onDelete('cascade');
                  
            $table->timestamps();
            
            // Ensure a user can't save the same business multiple times
            $table->unique(['user_id', 'business_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_businesses');
    }
};
