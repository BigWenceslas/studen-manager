<?php

namespace Database\Seeders;

use App\Models\Niveau;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $niveau = Niveau::create([
            'intitule' => 'I',
            'description' => "Niveau 1 de l'ecole"
        ]);
        $niveau = Niveau::create([
            'intitule' => 'II',
            'description' => "Niveau 2 de l'ecole"
        ]);
        $niveau = Niveau::create([
            'intitule' => 'III',
            'description' => "Niveau 3 de l'ecole"
        ]);
        $niveau = Niveau::create([
            'intitule' => 'IV',
            'description' => "Niveau 4 de l'ecole"
        ]);
        $niveau = Niveau::create([
            'intitule' => 'V',
            'description' => "Niveau 5 de l'ecole"
        ]);
    }
}
