<?php

namespace Database\Seeders;

use App\Models\ReptileBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReptileBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reptileBreeds = [
            'Leopard Gecko',
            'Ball Python',
            'Bearded Dragon',
            'Corn Snake',
            'Red-Eared Slider Turtle',
            'Crested Gecko',
            'Iguana',
            'Russian Tortoise'
        ];

        foreach ($reptileBreeds as $breed) {
            ReptileBreed::create(['name' => $breed]);
        }
    }
}
