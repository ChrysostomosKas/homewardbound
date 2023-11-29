<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AdoptionAd;
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
            AmphibianBreedSeeder::class,
            BirdBreedSeeder::class,
            CatBreedSeeder::class,
            DogBreedSeeder::class,
            FishBreedSeeder::class,
            HamsterBreedSeeder::class,
            HorseBreedSeeder::class,
            RabbitBreedSeeder::class,
            ReptileBreedSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);

        User::factory(10)->create();
        AdoptionAd::factory(10)->create();

        $user = User::factory()->create([
            'email' => 'test@test.com',
            'first_name' => 'Chrysostomos',
            'last_name' => 'Kasapidis',
        ]);

        $user->assignRole('admin');
    }
}
