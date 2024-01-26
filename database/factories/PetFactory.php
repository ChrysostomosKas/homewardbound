<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'species' => $this->faker->randomElement(['Dog', 'Cat', 'Rabbit']),
            'breed' => $this->faker->word,
            'age' => $this->faker->numberBetween(1, 10),
            'weight' => $this->faker->randomFloat(2, 1, 50),
            'color' => $this->faker->colorName,
            'special_needs' => $this->faker->sentence(8),
            'microchip_number' => $this->faker->numberBetween('11111111', '99999999'),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
