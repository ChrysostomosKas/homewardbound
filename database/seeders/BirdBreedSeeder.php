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
            'Budgerigar (Budgie)' => ['Καναρίνι (Budgie)', 'Budgerigar (Budgie)'],
            'Canary' => ['Καναρίνι', 'Canary'],
            'Cockatoo' => ['Κοκατού', 'Cockatoo'],
            'African Grey Parrot' => ['Αφρικανικός Γκρι Παπαγάλος', 'African Grey Parrot'],
            'Amazon Parrot' => ['Παπαγάλος του Αμαζονίου', 'Amazon Parrot'],
            'Macaw' => ['Παπαγάλος Macaw', 'Macaw'],
            'Finch' => ['Τσίχλα', 'Finch'],
            'Parakeet' => ['Παπαγάλος Parakeet', 'Parakeet'],
            'Quaker Parrot' => ['Παπαγάλος Quaker', 'Quaker Parrot'],
            'Caique' => ['Παπαγάλος Καΐκ', 'Caique'],
            'Lorikeet' => ['Παπαγάλος Λορικήτ', 'Lorikeet'],
            'Eclectus Parrot' => ['Παπαγάλος Eclectus', 'Eclectus Parrot'],
        ];

        foreach ($birdBreeds as $breed) {
            BirdBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
