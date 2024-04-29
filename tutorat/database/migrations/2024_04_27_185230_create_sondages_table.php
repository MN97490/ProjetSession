<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('sondages', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('status')->default('en cours');
            $table->string('type')->default('question');
            $table->text('description')->nullable();
            $table->float('ratingSondage')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('sondages');
    }
};

