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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->string('plate_number')->unique();
            $table->decimal('price_per_day', 10, 2);
            $table->text('description');
            $table->string('image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->integer('seats')->default(4);
            $table->enum('transmission', ['manual', 'automatic'])->default('manual');
            $table->enum('fuel_type', ['bensin', 'diesel', 'electric', 'hybrid'])->default('bensin');
            $table->boolean('is_available')->default(true);
            $table->integer('stock')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
