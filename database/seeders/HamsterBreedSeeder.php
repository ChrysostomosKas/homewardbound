<?php

namespace Database\Seeders;

use App\Models\HamsterBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HamsterBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hamsterBreeds = [
            'Syrian Hamster (Golden Hamster)' => ['Συριακό Χάμστερ (Χρυσό Χάμστερ)', 'Syrian Hamster (Golden Hamster)'],
            'Dwarf Hamster' => ['Κοντόποδο Χάμστερ', 'Dwarf Hamster'],
            'Roborovski Hamster' => ['Χάμστερ Ρομπορόφσκι', 'Roborovski Hamster'],
            'Chinese Hamster' => ['Κινέζικο Χάμστερ', 'Chinese Hamster'],
            'Campbells Dwarf Hamster' => ['Κοντόποδο Χάμστερ του Κάμπελ', 'Campbells Dwarf Hamster'],
            'Winter White Russian Dwarf Hamster' => ['Χειμερινός Λευκός Ρωσικός Κοντόποδος Χάμστερ', 'Winter White Russian Dwarf Hamster'],
        ];

        foreach ($hamsterBreeds as $breed) {
            HamsterBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
