<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('usagers')->insert([
            [
                'id' => 1,
                'nomUtilisateur' => 'admin',
                'nom' => 'nomAdmin',
                'prenom' => 'prenomAdmin',
                'email' => 'admin@email.com',
                'domaineEtude'=> '1',
                'is_tuteur'=>'0',
                'password' => Hash::make('qwerty'),
                'type' => 'admin',
            ],
            [
                'id' => 2,
                'nomUtilisateur' => 'prof',
                'nom' => 'nomNormal',
                'prenom' => 'prenomNormal',
                'email' => 'normal@email.com',
                'domaineEtude'=> '1',
                'is_tuteur'=>'0',
                'password' => Hash::make('qwerty'),
                'type' => 'prof',
            ],
            [
                'id' => 3,
                'nomUtilisateur' => 'eleve',
                'nom' => 'nomKid',
                'prenom' => 'prenomKid',
                'email' => 'kid@email.com',
                'domaineEtude'=> '1',
                'is_tuteur'=>'1',
                'password' => Hash::make('qwerty'),
                'type' => 'eleve',
            ]
        ]);
    }
}
