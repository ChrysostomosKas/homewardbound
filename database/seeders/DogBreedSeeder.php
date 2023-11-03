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
            'Labrador Retriever' => ['Λαμπραντόρ Ριτρίβερ', 'Labrador Retriever'],
            'German Shepherd' => ['Γερμανικός Ποιμενικός', 'German Shepherd'],
            'Golden Retriever' => ['Χρυσός Ριτρίβερ', 'Golden Retriever'],
            'French Bulldog' => ['Γαλλικός Μπουλντόγκ', 'French Bulldog'],
            'Bulldog' => ['Μπουλντόγκ', 'Bulldog'],
            'Poodle (Standard)' => ['Κανονικό Πουντλ', 'Poodle (Standard)'],
            'Poodle (Miniature)' => ['Μικρόσωμο Πουντλ', 'Poodle (Miniature)'],
            'Poodle (Toy)' => ['Παιχνιδοπούντλ', 'Poodle (Toy)'],
            'Beagle' => ['Μπίγκλ', 'Beagle'],
            'Rottweiler' => ['Ροτβάιλερ', 'Rottweiler'],
            'Yorkshire Terrier' => ['Υορκσάιρ Τεριέ', 'Yorkshire Terrier'],
            'Boxer' => ['Μπόξερ', 'Boxer'],
            'Dachshund' => ['Ντάξχουντ', 'Dachshund'],
            'Siberian Husky' => ['Σιβηριανός Χάσκι', 'Siberian Husky'],
            'Doberman Pinscher' => ['Ντόμπερμαν Πίνσερ', 'Doberman Pinscher'],
            'Shih Tzu' => ['Σι Τσου', 'Shih Tzu'],
            'Great Dane' => ['Μεγάλο Δανός', 'Great Dane'],
            'Australian Shepherd' => ['Αυστραλέζικος Ποιμενικός', 'Australian Shepherd'],
            'Border Collie' => ['Βόρντερ Κόλι', 'Border Collie'],
            'Shetland Sheepdog' => ['Σέτλαντ Σίπντογκ', 'Shetland Sheepdog'],
            'Pembroke Welsh Corgi' => ['Πέμπροκ Γουελς Κόργκι', 'Pembroke Welsh Corgi'],
            'Australian Cattle Dog' => ['Αυστραλέζικος Σκύλος Κτηνοτρόφου', 'Australian Cattle Dog'],
            'Chihuahua' => ['Τσιουάουα', 'Chihuahua'],
            'Bichon Frise' => ['Μπισόν Φρίζε', 'Bichon Frise'],
            'American Pit Bull Terrier' => ['Αμερικανικός Πιτ Μπουλ Τεριέ', 'American Pit Bull Terrier'],
            'Miniature Schnauzer' => ['Μικρόσωμος Σνάουζερ', 'Miniature Schnauzer'],
            'Shiba Inu' => ['Σιμπά Ίνου', 'Shiba Inu'],
            'Boston Terrier' => ['Βοστώνη Τεριέ', 'Boston Terrier'],
            'Havanese' => ['Χαβάνεζ', 'Havanese'],
            'Cavalier King Charles Spaniel' => ['Καβαλιέ Κινγκ Τσάρλς Σπανιέλ', 'Cavalier King Charles Spaniel'],
            'Pug' => ['Παγκ', 'Pug'],
            'Alaskan Malamute' => ['Αλάσκα Μαλαμούτ', 'Alaskan Malamute'],
            'Scottish Terrier' => ['Σκωτσέζικος Τεριέ', 'Scottish Terrier'],
            'Rhodesian Ridgeback' => ['Ροντέζιαν Ρίτζμπακ', 'Rhodesian Ridgeback'],
            'Irish Setter' => ['Ιρλανδικός Σέτερ', 'Irish Setter'],
            'Newfoundland' => ['Νιούφάντλαντ', 'Newfoundland'],
            'Bernese Mountain Dog' => ['Μπερνέζ Μάουντιν Ντογ', 'Bernese Mountain Dog'],
            'Samoyed' => ['Σαμόγιεντ', 'Samoyed'],
            'Staffordshire Bull Terrier' => ['Στάφορντσάιρ Μπουλ Τεριέ', 'Staffordshire Bull Terrier'],
            'Maltese' => ['Μαλτέζ', 'Maltese'],
            'American Bulldog' => ['Αμερικανικός Μπουλντόγκ', 'American Bulldog'],
            'Bullmastiff' => ['Μπουλμαστίφ', 'Bullmastiff'],
            'Dalmatian' => ['Δάλματιαν', 'Dalmatian'],
            'Weimaraner' => ['Βάϊμαρανερ', 'Weimaraner'],
            'Vizsla' => ['Βίζλα', 'Vizsla'],
            'Papillon' => ['Παπιγιόν', 'Papillon'],
            'Basset Hound' => ['Μπασέ Χάουντ', 'Basset Hound'],
            'Bloodhound' => ['Μπλάουντχαουντ', 'Bloodhound'],
            'American Eskimo Dog' => ['Αμερικανικός Εσκιμό Σκύλος', 'American Eskimo Dog'],
            'Old English Sheepdog' => ['Παλιός Αγγλικός Ποιμενικός', 'Old English Sheepdog'],
            'Belgian Malinois' => ['Βέλγιος Μαλινουά', 'Belgian Malinois'],
            'Bull Terrier' => ['Μπουλ Τεριέ', 'Bull Terrier'],
            'Border Terrier' => ['Βόρντερ Τεριέ', 'Border Terrier'],
            'Cairn Terrier' => ['Κέρν Τεριέ', 'Cairn Terrier'],
            'West Highland White Terrier' => ['Τεριέ Δυτικού Χάιλαντ Άσπρο', 'West Highland White Terrier'],
            'Tibetan Terrier' => ['Τιβετιαν Τεριέ', 'Tibetan Terrier'],
            'Lhasa Apso' => ['Λάσα Άπσο', 'Lhasa Apso'],
            'Afghan Hound' => ['Αφγανικός Χάουντ', 'Afghan Hound'],
            'Basenji' => ['Μπασέντζι', 'Basenji'],
            'Chinese Crested' => ['Κινέζικο Κρέστεντ', 'Chinese Crested'],
            'American Staffordshire Terrier' => ['Αμερικανικός Στάφορντσάιρ Τεριέ', 'American Staffordshire Terrier'],
            'Scottish Deerhound' => ['Σκωτσέζικος Σκυλάκι Αγριοδιάβολου', 'Scottish Deerhound'],
            'Portuguese Water Dog' => ['Πορτογαλικός Σκύλος του Νερού', 'Portuguese Water Dog'],
            'Irish Wolfhound' => ['Ιρλανδικός Σκύλος του Λύκου', 'Irish Wolfhound'],
            'Norwegian Elkhound' => ['Νορβηγικός Σκύλος του Ελάφι', 'Norwegian Elkhound'],
            'Leonberger' => ['Λεόνμπεργκερ', 'Leonberger'],
            'Greater Swiss Mountain Dog' => ['Μεγάλος Ελβετικός Ορεινός Σκύλος', 'Greater Swiss Mountain Dog'],
            'Shiloh Shepherd' => ['Σιλό Σέπερντ', 'Shiloh Shepherd'],
            'Tibetan Mastiff' => ['Τιβετιανός Μαστίφ', 'Tibetan Mastiff'],
            'Neapolitan Mastiff' => ['Νεάπολιτανος Μαστίφ', 'Neapolitan Mastiff'],
            'Cane Corso' => ['Κάνε Κορσό', 'Cane Corso'],
            'Portuguese Podengo' => ['Πορτογαλικός Ποδένγκο', 'Portuguese Podengo'],
            'Saluki' => ['Σαλούκι', 'Saluki'],
            'Rhodesian Ridgeless' => ['Ροντέζιαν Ρίτζμπακ', 'Rhodesian Ridgeless'],
            'Japanese Chin' => ['Ιαπωνικό Τσιν', 'Japanese Chin'],
            'American Water Spaniel' => ['Αμερικανικός Σκύλος του Νερού', 'American Water Spaniel'],
            'Clumber Spaniel' => ['Κλάμπερ Σπάνιελ', 'Clumber Spaniel'],
            'Irish Water Spaniel' => ['Ιρλανδικός Σκύλος του Νερού', 'Irish Water Spaniel'],
            'Field Spaniel' => ['Φιλντ Σπάνιελ', 'Field Spaniel'],
            'Sussex Spaniel' => ['Σάξεξ Σπάνιελ', 'Sussex Spaniel'],
            'Toy Fox Terrier' => ['Τοϊ Φοξ Τεριέ', 'Toy Fox Terrier'],
            'English Toy Spaniel' => ['Αγγλικό Τοϊ Σπάνιελ', 'English Toy Spaniel'],
        ];

        foreach ($dogBreeds as $breed) {
            DogBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
