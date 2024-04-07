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
        Schema::create('usagers', function (Blueprint $table) {
            $table->id();
            $table->string('email',190);
            $table->string('password');
            $table->string('nomUtilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->foreignId('domaineEtude')->constrained('domaineEtudes');
            $table->set('type',['admin','prof','eleve']);
            $table->boolean('is_tuteur');
            $table->unique('email');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usagers');
    }
};