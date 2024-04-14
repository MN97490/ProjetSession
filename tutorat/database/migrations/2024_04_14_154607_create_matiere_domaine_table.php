<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatiereDomaineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matiere_domaine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matiere_id')->constrained('matieres');
            $table->foreignId('domaine_id')->constrained('domaines');
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matiere_domaine');
    }
}
