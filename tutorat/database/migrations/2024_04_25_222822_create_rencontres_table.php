<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rencontres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tuteur_id')->constrained('usagers');
            $table->foreignId('eleve_id')->constrained('usagers');
            $table->string('status')->default('à venir');
            $table->dateTime('heure_debut');
            $table->dateTime('heure_fin');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencontres');
    }
};
