<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hotel_information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->text('description');
            $table->string('main_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_information');
    }
};