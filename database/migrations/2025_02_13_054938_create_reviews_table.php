<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('restaurants_id');
            $table->integer('score')->check('score BETWEEN 1 AND 5');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurants_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('reviews');
    }
};