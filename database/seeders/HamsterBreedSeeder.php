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
            'Syrian Hamster (Golden Hamster)',
            'Dwarf Hamster',
            'Roborovski Hamster',
            'Chinese Hamster',
            'Campbells Dwarf Hamster',
            'Winter White Russian Dwarf Hamster',
        ];

        foreach ($hamsterBreeds as $breed) {
            HamsterBreed::create(['name' => $breed]);
        }
    }
}
