<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('food_images', function (Blueprint $table) {
            $table->id('id_food_image');
            $table->unsignedBigInteger('id_restaurant');
            $table->text('image_url');
            
            $table->foreign('id_restaurant')->references('id_restaurant')->on('restaurants');
        });
    }

    public function down() {
        Schema::dropIfExists('food_images');
    }
};