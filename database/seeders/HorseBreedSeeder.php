<?php

namespace Database\Seeders;

use App\Models\HorseBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorseBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horseBreeds = [
            'Aegidienberger',
            'American Cream Draft',
            'American Miniature Horse',
            'American Paint Horse',
            'American Quarter Horse',
            'American Saddlebred',
            'American Sugarbush Harlequin Draft',
            'Andalusian',
            'Appaloosa',
            'Arabian',
            'Bajau Pony',
            'Black Forest Horse',
            'Blazer',
            'British Appaloosa',
            'British Riding Pony',
            'British Spotted Pony',
            'Camarillo White Horse',
            'Caspian',
            'Cheval Canadien',
            'Cleveland Bay',
            'Colorado Ranger',
            'Connemara Pony',
            'Curly Horse',
            'Dales Pony',
            'Dartmoor Pony',
            'Eriskay Pony',
            'Exmoor Pony',
            'Faroese Pony',
            'Florida Cracker Horse',
            'Friesian',
            'Friesian Heritage Horse',
            'Galiceno',
            'Georgian Grande',
            'Gypsy Vanner',
            'Icelandic',
            'Irish Cob',
            'Irish Draught',
            'Kentucky Mountain Saddle Horse',
            'Kerry Bog Pony',
            'Kuda Padi',
            'Lombok Horse',
            'McCurdy Plantation Horse',
            'Missouri Fox Trotter',
            'Morab',
            'Morgan',
            'Moriesian',
            'Mountain Pleasure Horse',
            'National Show Horse',
            'Forest Pony',
            'Newfoundland Pony',
            'Nez Perce Horse',
            'Norwegian Fjord',
            'Nokota',
            'Peruvian Horse',
            'Pintabian',
            'Racking Horse',
            'Quarab',
            'Quarter Pony',
            'Rocky Mountain Horse',
            'Shire',
            'Smokey Valley Horse',
            'Spanish Mustang',
            'Spotted Saddle Horse',
            'Standardbred',
            'Stonewall Sporthorse',
            'Sulphur Horse',
            'Sumba Horse',
            'Tennessee Walking Horse',
            'Thoroughbred',
            'Walkaloosa',
            'Welara Pony',
            'Welsh Pony & Cob'
        ];

        foreach ($horseBreeds as $breed) {
            HorseBreed::create(['name' => $breed]);
        }
    }
}
