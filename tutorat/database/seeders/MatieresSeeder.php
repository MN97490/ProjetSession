<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MatieresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matieres')->insert([
            [
                'id' => 1,
                'nomMatiere' => 'BD',
                
               
            ],
            [
                'id' => 2,
                'nomMatiere' => 'Web',
                
            ],
            [
                'id' => 3,
                'nomMatiere' => 'POO',
               
            ]
        ]);
    }
}
