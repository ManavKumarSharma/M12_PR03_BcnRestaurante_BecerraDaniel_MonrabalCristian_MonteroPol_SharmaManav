<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('zones', function (Blueprint $table) {
            $table->id('id_zone');
            $table->string('name_zone');
        });
    }

    public function down() {
        Schema::dropIfExists('zones');
    }
};
