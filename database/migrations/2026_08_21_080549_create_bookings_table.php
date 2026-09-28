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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('pickup_time')->nullable();
            $table->time('return_time')->nullable();
            $table->decimal('total_price', 12, 2);
            $table->decimal('deposit', 12, 2)->nullable();
            $table->enum('status', [
                'pending', 'confirmed', 'processing', 
                'active', 'completed', 'cancelled', 'rejected'
            ])->default('pending');
            $table->text('notes')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('return_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
