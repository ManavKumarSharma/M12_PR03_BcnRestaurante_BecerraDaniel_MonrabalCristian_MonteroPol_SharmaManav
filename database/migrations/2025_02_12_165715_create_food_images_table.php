<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('food_images', function (Blueprint $table) {
            $table->id('id_foods_images');
            $table->unsignedBigInteger('restaurant_id_restaurants');
            $table->longText('image_url');
            $table->timestamps();

            $table->foreign('restaurant_id_restaurants')->references('id_restaurants')->on('restaurants');
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_images');
    }
};
