<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteEtudiantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('noteEtudiants')->insert([
            [
                'id' => 1,
                'idMatiere' => 1,
                'idCompte'=> 1,
                'Note'=>95.5
               
            ],
            [
                'id' => 2,
                'idMatiere' => 1,
                'idCompte'=> 1,
                'Note'=>90
               
            ],
            [
                'id' => 3,
                'idMatiere' => 1,
                'idCompte'=> 1,
                'Note'=>70
               
            ]
        ]);
    }
}
