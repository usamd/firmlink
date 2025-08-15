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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->morphs('followable');
            $table->enum('status', ['active', 'pending', 'blocked'])->default('active');
            $table->timestamps();

            $table->unique(['follower_id', 'followable_id', 'followable_type']);
            $table->index(['followable_id', 'followable_type']);
            $table->index(['follower_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
