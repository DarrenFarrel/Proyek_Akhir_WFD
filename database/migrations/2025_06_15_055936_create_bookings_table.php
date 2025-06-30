<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->text('special_requests')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }
   
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};