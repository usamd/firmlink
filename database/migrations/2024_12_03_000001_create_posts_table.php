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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_id')->nullable();
            $table->string('title')->nullable();
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->enum('post_type', ['text', 'image', 'video', 'story', 'promotion'])->default('text');
            $table->enum('status', ['active', 'inactive', 'pending', 'reported', 'published', 'draft', 'suspended', 'deleted'])->default('active');
            $table->boolean('is_promoted')->default(false);
            $table->string('location')->nullable();
            $table->json('tags')->nullable();
            $table->enum('privacy_level', ['public', 'private', 'friends'])->default('public');
            $table->integer('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint with correct column reference
            $table->foreign('business_id')->references('businesses_id')->on('businesses')->onDelete('cascade');

            $table->index(['user_id', 'created_at']);
            $table->index(['business_id', 'created_at']);
            $table->index(['post_type', 'status']);
            $table->index(['is_promoted', 'status']);
            $table->index('privacy_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
