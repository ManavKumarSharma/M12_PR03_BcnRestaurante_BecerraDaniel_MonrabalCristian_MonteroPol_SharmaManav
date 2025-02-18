<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('rol_id')->nullable();
            $table->text('profile_image')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
};