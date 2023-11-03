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
            'Holland Lop' => ['Ολλανδικό Λοπ', 'Holland Lop'],
            'Mini Rex' => ['Μικρό Ρεξ', 'Mini Rex'],
            'Netherland Dwarf' => ['Κοντόποδο της Ολλανδίας', 'Netherland Dwarf'],
            'Flemish Giant' => ['Φλαμανδικός Γίγαντας', 'Flemish Giant'],
            'Lionhead' => ['Λιοντάρι', 'Lionhead'],
            'Rex' => ['Ρεξ', 'Rex'],
            'New Zealand White' => ['Λευκό της Νέας Ζηλανδίας', 'New Zealand White'],
            'Himalayan' => ['Ιμαλάιος', 'Himalayan'],
            'Angora' => ['Αγκόρα', 'Angora'],
            'Californian' => ['Καλιφορνέζ', 'Californian'],
            'English Angora' => ['Αγγλικός Αγκόρα', 'English Angora'],
            'French Angora' => ['Γαλλικός Αγκόρα', 'French Angora'],
            'Polish' => ['Πολωνέζικος', 'Polish'],
            'Jersey Wooly' => ['Τζέρσεϊ Γουλι', 'Jersey Wooly'],
            'Mini Lop' => ['Μικρό Λοπ', 'Mini Lop'],
            'Havana' => ['Αβάνα', 'Havana'],
            'Silver Fox' => ['Ασημένια Αλεπού', 'Silver Fox']
        ];

        foreach ($rabbitBreeds as $breed) {
            RabbitBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
