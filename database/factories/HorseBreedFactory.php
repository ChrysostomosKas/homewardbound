<?php

namespace Database\Factories;

use App\Models\HorseBreed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HorseBreed>
 */
class HorseBreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
        ];
    }
}
