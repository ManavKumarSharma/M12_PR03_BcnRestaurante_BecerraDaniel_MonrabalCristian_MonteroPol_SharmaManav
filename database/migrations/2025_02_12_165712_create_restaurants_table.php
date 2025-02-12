<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id('id_restaurants');
            $table->string('name', 255);
            $table->longText('description');
            $table->longText('location');
            $table->longText('img_restaurant')->nullable();
            $table->integer('average_price')->nullable();
            $table->string('phone', 9)->nullable();
            $table->time('opening_hours')->nullable();
            $table->time('closing_hours')->nullable();
            $table->unsignedBigInteger('manager_id_users');
            $table->timestamps();

            $table->foreign('manager_id_users')->references('id_users')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
