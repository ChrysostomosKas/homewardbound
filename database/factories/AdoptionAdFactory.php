<?php

namespace Database\Factories;

use App\Enums\AdoptionAdStatus;
use App\Enums\PetCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdoptionAd>
 */
class AdoptionAdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'type_of_pet' => PetCategory::Dog->name,
            'status' => AdoptionAdStatus::Open->name,
            'breed' => $this->faker->word,
            'age' => $this->faker->numberBetween(1, 10),
            'size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'color' => $this->faker->colorName,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'vaccination_status' => $this->faker->boolean,
            'spaying_neutering_status' => $this->faker->boolean,
            'health_condition' => $this->faker->sentence,
            'location' => $this->faker->city,
            'contact_phone_number' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->email,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
