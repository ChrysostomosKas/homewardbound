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
            'American Bullfrog' => ['Αμερικανικός βάτραχος', 'American Bullfrog'],
            'African Clawed Frog' => ['Αφρικανικός βάτραχος με γανχία', 'African Clawed Frog'],
            'Fire-Bellied Toad' => ['Βάτραχος με κόκκινη κοιλίτσα', 'Fire-Bellied Toad'],
            'Eastern Newt' => ['Ανατολικός τρίτωνας', 'Eastern Newt'],
            'Pacman Frog' => ['Βάτραχος Pacman', 'Pacman Frog'],
            'Red-Eyed Tree Frog' => ['Βάτραχος με κόκκινα μάτια', 'Red-Eyed Tree Frog'],
            'Salamander' => ['Σαλαμάνδρα', 'Salamander'],
            'Dart Frog' => ['Βάτραχος βελόνης', 'Dart Frog'],
        ];

        foreach ($amphibianBreeds as $breed) {
            AmphibianBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
