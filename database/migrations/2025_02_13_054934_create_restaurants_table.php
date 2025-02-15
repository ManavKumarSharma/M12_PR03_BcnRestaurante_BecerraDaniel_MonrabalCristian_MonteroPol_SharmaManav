<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('location');
            $table->text('img_restaurant')->nullable();
            $table->integer('average_price')->nullable();
            $table->string('phone', 15)->nullable();
            $table->time('opening_hours')->nullable();
            $table->time('closing_hours')->nullable();
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('zones_id');
            $table->timestamps();

            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('zones_id')->references('id')->on('zones')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('restaurants');
    }
};