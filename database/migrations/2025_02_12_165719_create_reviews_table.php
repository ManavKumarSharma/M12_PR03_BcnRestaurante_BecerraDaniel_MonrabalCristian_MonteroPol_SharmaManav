<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_reviews');
            $table->unsignedBigInteger('user_id_users');
            $table->unsignedBigInteger('restaurant_id_restaurants');
            $table->integer('score')->checkBetween(1, 5);
            $table->longText('comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id_users')->references('id_users')->on('users');
            $table->foreign('restaurant_id_restaurants')->references('id_restaurants')->on('restaurants');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
