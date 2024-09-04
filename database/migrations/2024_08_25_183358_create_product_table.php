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
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_id'); // Auto-incrementing ID
            $table->string('product_name');
            $table->string('location');
            $table->integer('quantity');
            $table->unsignedBigInteger('businesses_id'); // Explicitly define as unsigned BIGINT
            $table->foreign('businesses_id')->references('businesses_id')->on('businesses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
