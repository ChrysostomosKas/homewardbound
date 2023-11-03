<?php

namespace Database\Seeders;

use App\Models\RabbitBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RabbitBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rabbitBreeds = [
            'Holland Lop',
            'Mini Rex',
            'Netherland Dwarf',
            'Flemish Giant',
            'Lionhead',
            'Rex',
            'New Zealand White',
            'Himalayan',
            'Angora',
            'Californian',
            'English Angora',
            'French Angora',
            'Polish',
            'Jersey Wooly',
            'Mini Lop',
            'Havana',
            'Silver Fox'
        ];

        foreach ($rabbitBreeds as $breed) {
            RabbitBreed::create(['name' => $breed]);
        }
    }
}
