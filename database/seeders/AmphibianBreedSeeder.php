<?php

namespace Database\Seeders;

use App\Models\AmphibianBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmphibianBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amphibianBreeds = [
            'American Bullfrog',
            'African Clawed Frog',
            'Fire-Bellied Toad',
            'Eastern Newt',
            'Pacman Frog',
            'Red-Eyed Tree Frog',
            'Salamander',
            'Dart Frog'
        ];

        foreach ($amphibianBreeds as $breed) {
            AmphibianBreed::create(['name' => $breed]);
        }
    }
}
