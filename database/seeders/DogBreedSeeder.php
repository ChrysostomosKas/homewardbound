<?php

namespace Database\Seeders;

use App\Models\DogBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DogBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dogBreeds = [
            'Labrador Retriever',
            'German Shepherd',
            'Golden Retriever',
            'French Bulldog',
            'Bulldog',
            'Poodle (Standard)',
            'Poodle (Miniature)',
            'Poodle (Toy)',
            'Beagle',
            'Rottweiler',
            'Yorkshire Terrier',
            'Boxer',
            'Dachshund',
            'Siberian Husky',
            'Doberman Pinscher',
            'Shih Tzu',
            'Great Dane',
            'Australian Shepherd',
            'Border Collie',
            'Shetland Sheepdog',
            'Pembroke Welsh Corgi',
            'Australian Cattle Dog',
            'Chihuahua',
            'Bichon Frise',
            'American Pit Bull Terrier',
            'Miniature Schnauzer',
            'Shiba Inu',
            'Boston Terrier',
            'Havanese',
            'Cavalier King Charles Spaniel',
            'Pug',
            'Alaskan Malamute',
            'Scottish Terrier',
            'Rhodesian Ridgeback',
            'Irish Setter',
            'Newfoundland',
            'Bernese Mountain Dog',
            'Samoyed',
            'Staffordshire Bull Terrier',
            'Maltese',
            'American Bulldog',
            'Bullmastiff',
            'Dalmatian',
            'Weimaraner',
            'Vizsla',
            'Papillon',
            'Basset Hound',
            'Bloodhound',
            'American Eskimo Dog',
            'Old English Sheepdog',
            'Belgian Malinois',
            'Bull Terrier',
            'Border Terrier',
            'Cairn Terrier',
            'West Highland White Terrier',
            'Tibetan Terrier',
            'Lhasa Apso',
            'Afghan Hound',
            'Basenji',
            'Chinese Crested',
            'American Staffordshire Terrier',
            'Scottish Deerhound',
            'Portuguese Water Dog',
            'Irish Wolfhound',
            'Norwegian Elkhound',
            'Leonberger',
            'Greater Swiss Mountain Dog',
            'Shiloh Shepherd',
            'Tibetan Mastiff',
            'Neapolitan Mastiff',
            'Cane Corso',
            'Portuguese Podengo',
            'Saluki',
            'Rhodesian Ridgeless',
            'Japanese Chin',
            'American Water Spaniel',
            'Clumber Spaniel',
            'Irish Water Spaniel',
            'Field Spaniel',
            'Sussex Spaniel',
            'Toy Fox Terrier',
            'English Toy Spaniel',
        ];

        foreach ($dogBreeds as $breed) {
            DogBreed::create(['name' => $breed]);
        }
    }
}
