<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('restaurant_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurants_id');
            $table->unsignedBigInteger('tags_id');
            $table->timestamps();

            $table->foreign('restaurants_id')->references('id')->on('restaurants');
            $table->foreign('tags_id')->references('id')->on('tags');
        });
    }

    public function down() {
        Schema::dropIfExists('restaurant_tags');
    }
};