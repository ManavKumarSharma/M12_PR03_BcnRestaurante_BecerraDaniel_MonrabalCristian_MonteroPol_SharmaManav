<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('restaurant_tags', function (Blueprint $table) {
            $table->id('id_restaurant_tags');
            $table->unsignedBigInteger('id_restaurant');
            $table->unsignedBigInteger('id_tag');

            $table->foreign('id_restaurant')->references('id_restaurant')->on('restaurants');
            $table->foreign('id_tag')->references('id_tag')->on('tags');
        });
    }

    public function down() {
        Schema::dropIfExists('restaurant_tags');
    }
};