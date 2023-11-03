<?php

namespace Database\Seeders;

use App\Models\CatBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catBreeds = [
            'Siamese',
            'Persian',
            'Maine Coon',
            'British Shorthair',
            'Bengal',
            'Ragdoll',
            'Sphynx',
            'Abyssinian',
            'Scottish Fold',
            'American Shorthair',
            'Russian Blue',
            'Oriental Shorthair',
            'Birman',
            'Devon Rex',
            'Cornish Rex',
            'Himalayan',
            'Manx',
            'Turkish Van',
            'Tonkinese',
            'Norwegian Forest Cat',
            'Siberian',
            'Exotic Shorthair',
            'Chartreux',
            'Balinese',
            'Egyptian Mau',
            'Ragamuffin',
            'Selkirk Rex',
            'Havana Brown',
            'Burmese',
            'Japanese Bobtail',
            'American Bobtail',
            'Munchkin',
            'LaPerm',
            'Singapura',
            'Savannah',
            'Pixie-Bob',
            'Chausie',
            'American Curl',
            'Somali',
            'Toyger',
            'Serengeti',
            'Cymric',
            'Highlander',
            'Nebelung',
            'Korat',
            'Ocicat',
            'Peterbald',
            'RagaMuffin',
            'Toyger',
            'Cheetoh',
        ];

        foreach ($catBreeds as $breed) {
            CatBreed::create(['name' => $breed]);
        }
    }
}
