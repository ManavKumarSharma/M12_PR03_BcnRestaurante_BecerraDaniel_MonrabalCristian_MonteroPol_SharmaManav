<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_review');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_restaurant');
            $table->integer('score')->check('score BETWEEN 1 AND 5');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_restaurant')->references('id_restaurant')->on('restaurants');
        });
    }

    public function down() {
        Schema::dropIfExists('reviews');
    }
};