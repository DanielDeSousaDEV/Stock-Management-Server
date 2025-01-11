<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(3),
            'street_name' => fake()->streetName(),
            'number' => fake()->randomNumber(2),
            'complement' => fake()->paragraph(1, true),
            'neighborhood' => fake()->words(2, true),
            // 'state' => fake()->regionAbbr(),
            'city' => fake()->city(),
            'CEP' => fake()->numerify('#####-###'),
        ];
    }
}
