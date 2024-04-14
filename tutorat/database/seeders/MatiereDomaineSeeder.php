<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatiereDomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
     
        DB::table('matiere_domaine')->insert([
            [
                'matiere_id' => 1,
                'domaine_id' => 1
            ],
            [
                'matiere_id' => 2,
                'domaine_id' => 1
            ],
            [
                'matiere_id' => 3,
                'domaine_id' => 1
            ],
          
        ]);
    }
}
