<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DogBreedSeeder::class,
            RolesAndPermissionsSeeder::class,
            HorseBreedSeeder::class,
            CatBreedSeeder::class,
            RabbitBreedSeeder::class,
            FishBreedSeeder::class,
            BirdBreedSeeder::class,
            HamsterBreedSeeder::class,
            ReptileBreedSeeder::class,
            AmphibianBreedSeeder::class
        ]);

        $user = User::factory()->create([
            'email' => 'test@test.com',
            'first_name' => 'Chrysostomos',
            'last_name' => 'Kasapidis',
        ]);
    }
}
