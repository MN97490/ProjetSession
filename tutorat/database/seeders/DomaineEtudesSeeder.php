<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomaineEtudesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('domaines')->insert([
            [
                'id' => 1,
                'nomDomaine' => 'Informatique'
               
            ],
            [
                'id' => 2,
                'nomDomaine' => 'Architecture'
            ],
            [
                'id' => 3,
                'nomDomaine' => 'Soin infirmier'
            ]
        ]);
    }
}
