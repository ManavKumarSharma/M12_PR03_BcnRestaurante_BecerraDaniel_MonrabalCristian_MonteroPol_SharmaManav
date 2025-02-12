<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('restaurant_tags', function (Blueprint $table) {
            $table->id('id_restaurant_tags');
            $table->unsignedBigInteger('restaurant_id_restaurants');
            $table->unsignedBigInteger('tag_id_tags');
            $table->timestamps();

            $table->foreign('restaurant_id_restaurants')->references('id_restaurants')->on('restaurants');
            $table->foreign('tag_id_tags')->references('id_tags')->on('tags');
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurant_tags');
    }
};
