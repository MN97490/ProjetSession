<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    public function up() {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sondage_id')->constrained('sondages')->onDelete('cascade');
            $table->text('contenu');
            $table->foreignId('user_id')->constrained('usagers')->onDelete('cascade');
            $table->integer('note')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('commentaires');
    }
};
