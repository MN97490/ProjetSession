<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(DomaineEtudesSeeder::class);
        $this->call(MatieresSeeder::class);
        $this->call(UsagersSeeder::class);
        $this->call(NoteEtudiantsSeeder::class);
        $this->call(MatiereDomaineSeeder::class);
       
        
    }
}
