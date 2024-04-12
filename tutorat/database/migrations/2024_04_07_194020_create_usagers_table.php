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
            $table->string('nomUtilisateur',8);
            $table->string('nom');
            $table->string('prenom');
            $table->foreignId('domaineEtude')->constrained('domaines');
            $table->set('role',['admin','prof','eleve']);
            $table->boolean('is_tuteur')->default(false);
            $table->unique('email');
            $table->unique('nomUtilisateur');
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
