<?php

namespace Database\Seeders;

use App\Models\FishBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FishBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fishBreeds = [
            'Goldfish',
            'Betta Fish',
            'Guppy',
            'Angelfish',
            'Tetra',
            'Cichlid',
            'Discus',
            'Koi',
            'Rainbowfish',
            'Molly',
            'Platy',
            'Swordtail',
            'Barb',
            'Plecostomus',
            'Danio',
            'Catfish',
            'Killifish',
        ];

        foreach ($fishBreeds as $breed) {
            FishBreed::create(['name' => $breed]);
        }
    }
}
