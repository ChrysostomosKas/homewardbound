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
            'Siamese' => ['Σιαμέζ', 'Siamese'],
            'Persian' => ['Περσικό', 'Persian'],
            'Maine Coon' => ['Μέιν Κουν', 'Maine Coon'],
            'British Shorthair' => ['Βρετανική Σύντομη Τρίχα', 'British Shorthair'],
            'Bengal' => ['Βεγγάλη', 'Bengal'],
            'Ragdoll' => ['Ράγκντολ', 'Ragdoll'],
            'Sphynx' => ['Σφίγγα', 'Sphynx'],
            'Abyssinian' => ['Αβυσσινία', 'Abyssinian'],
            'Scottish Fold' => ['Σκωτική Στρογγυλή', 'Scottish Fold'],
            'American Shorthair' => ['Αμερικανική Σύντομη Τρίχα', 'American Shorthair'],
            'Russian Blue' => ['Ρωσικό Μπλε', 'Russian Blue'],
            'Oriental Shorthair' => ['Ανατολική Σύντομη Τρίχα', 'Oriental Shorthair'],
            'Birman' => ['Μπέρμαν', 'Birman'],
            'Devon Rex' => ['Ντέβον Ρεξ', 'Devon Rex'],
            'Cornish Rex' => ['Κόρνις Ρεξ', 'Cornish Rex'],
            'Himalayan' => ['Χιμαλαΐαν', 'Himalayan'],
            'Manx' => ['Μανξ', 'Manx'],
            'Turkish Van' => ['Τουρκικό Βαν', 'Turkish Van'],
            'Tonkinese' => ['Τονκινίζ', 'Tonkinese'],
            'Norwegian Forest Cat' => ['Νορβηγική Δασική Γάτα', 'Norwegian Forest Cat'],
            'Siberian' => ['Σιβηρική', 'Siberian'],
            'Exotic Shorthair' => ['Εξωτική Σύντομη Τρίχα', 'Exotic Shorthair'],
            'Chartreux' => ['Σαρτρώ', 'Chartreux'],
            'Balinese' => ['Μπαλινέζ', 'Balinese'],
            'Egyptian Mau' => ['Αιγυπτιακό Μαου', 'Egyptian Mau'],
            'Selkirk Rex' => ['Σέλκιρκ Ρεξ', 'Selkirk Rex'],
            'Havana Brown' => ['Χαβάνα Μπράουν', 'Havana Brown'],
            'Burmese' => ['Μπουρμεζ', 'Burmese'],
            'Japanese Bobtail' => ['Ιαπωνική Σύντομη Ουρά', 'Japanese Bobtail'],
            'American Bobtail' => ['Αμερικανική Σύντομη Ουρά', 'American Bobtail'],
            'Munchkin' => ['Μάντσκιν', 'Munchkin'],
            'LaPerm' => ['Λα Πέρμ', 'LaPerm'],
            'Singapura' => ['Σινγκαπούρα', 'Singapura'],
            'Savannah' => ['Σαβάννα', 'Savannah'],
            'Pixie-Bob' => ['Πίξι-Μπομπ', 'Pixie-Bob'],
            'Chausie' => ['Τσάουσι', 'Chausie'],
            'American Curl' => ['Αμερικανική Κέρλ', 'American Curl'],
            'Somali' => ['Σομάλι', 'Somali'],
            'Toyger' => ['Τόιγκερ', 'Toyger'],
            'Serengeti' => ['Σερενγκέτι', 'Serengeti'],
            'Cymric' => ['Κύμρικ', 'Cymric'],
            'Highlander' => ['Χάιλάντερ', 'Highlander'],
            'Nebelung' => ['Νέμπελουνγκ', 'Nebelung'],
            'Korat' => ['Κοράτ', 'Korat'],
            'Ocicat' => ['Οσίκατ', 'Ocicat'],
            'Peterbald' => ['Πέτερμπαλντ', 'Peterbald'],
            'RagaMuffin' => ['ΡάγκαΜάφιν', 'RagaMuffin'],
            'Cheetoh' => ['Τσίτο', 'Cheetoh'],
        ];

        foreach ($catBreeds as $breed) {
            CatBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
