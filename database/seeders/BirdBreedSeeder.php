<?php

namespace Database\Seeders;

use App\Models\BirdBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BirdBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $birdBreeds = [
            'Budgerigar (Budgie)',
            'Cockatiel',
            'Lovebird',
            'Canary',
            'Cockatoo',
            'African Grey Parrot',
            'Amazon Parrot',
            'Macaw',
            'Conure',
            'Finch',
            'Parakeet',
            'Quaker Parrot',
            'Caique',
            'Lorikeet',
            'Eclectus Parrot'
        ];

        foreach ($birdBreeds as $breed) {
            BirdBreed::create(['name' => $breed]);
        }
    }
}
