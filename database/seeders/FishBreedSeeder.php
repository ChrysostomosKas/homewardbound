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
            'Goldfish' => ['Χρυσόψαρο', 'Goldfish'],
            'Betta Fish' => ['Μπέτα Ψάρι', 'Betta Fish'],
            'Guppy' => ['Γκάπι', 'Guppy'],
            'Angelfish' => ['Αγγελόψαρο', 'Angelfish'],
            'Tetra' => ['Τέτρα', 'Tetra'],
            'Cichlid' => ['Κιχλίδα', 'Cichlid'],
            'Discus' => ['Δίσκος', 'Discus'],
            'Koi' => ['Κοϊ', 'Koi'],
            'Rainbowfish' => ['Ουράνιο Τόξο Ψάρι', 'Rainbowfish'],
            'Molly' => ['Μόλι', 'Molly'],
            'Platy' => ['Πλάτυ', 'Platy'],
            'Swordtail' => ['Σουόρνττέιλ', 'Swordtail'],
            'Barb' => ['Μπαρμπ', 'Barb'],
            'Plecostomus' => ['Πλεκοστόμους', 'Plecostomus'],
            'Danio' => ['Ντάνιο', 'Danio'],
            'Catfish' => ['Γάτα', 'Catfish'],
            'Killifish' => ['Κιλίφις', 'Killifish'],
        ];

        foreach ($fishBreeds as $breed) {
            FishBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
