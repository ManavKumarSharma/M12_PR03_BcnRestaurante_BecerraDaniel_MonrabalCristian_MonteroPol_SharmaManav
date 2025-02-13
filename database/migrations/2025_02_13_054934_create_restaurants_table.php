<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id('id_restaurant');
            $table->string('name');
            $table->text('description');
            $table->text('location');
            $table->text('img_restaurant')->nullable();
            $table->integer('average_price')->nullable();
            $table->string('phone', 15)->nullable();
            $table->time('opening_hours')->nullable();
            $table->time('closing_hours')->nullable();
            $table->unsignedBigInteger('id_manager');
            $table->unsignedBigInteger('id_zone');
            $table->timestamps();

            $table->foreign('id_manager')->references('id_user')->on('users');
            $table->foreign('id_zone')->references('id_zone')->on('zones');
        });
    }

    public function down() {
        Schema::dropIfExists('restaurants');
    }
};