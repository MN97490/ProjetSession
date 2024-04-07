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
        Schema::create('noteEtudiants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idMatiere')->constrained('matieres');
            $table->foreignId('idCompte')->constrained('usagers');
            $table->double('Note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noteEtudiants');
    }
};
