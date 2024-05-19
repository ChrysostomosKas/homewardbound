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
            'Leopard Gecko' => ['Λεοπάρντο Γεκο', 'Leopard Gecko'],
            'Ball Python' => ['Μπαλ Πάιθον', 'Ball Python'],
            'Bearded Dragon' => ['Πρεσβυτέριος Δράκος', 'Bearded Dragon'],
            'Corn Snake' => ['Στρόφιγγα', 'Corn Snake'],
            'Red-Eared Slider Turtle' => ['Χελώνα Κόκκινου Αυτιού', 'Red-Eared Slider Turtle'],
            'Crested Gecko' => ['Κρεστεντ Γεκο', 'Crested Gecko'],
            'Iguana' => ['Ιγκουάνα', 'Iguana'],
            'Russian Tortoise' => ['Ρωσική Χελώνα', 'Russian Tortoise']
        ];

        foreach ($reptileBreeds as $breed) {
            ReptileBreed::create([
                'name_gr' => $breed[0],
                'name_en' => $breed[1],
            ]);
        }
    }
}
