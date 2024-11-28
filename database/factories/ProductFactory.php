<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(2),
            'price' => fake()->randomFloat(2, 10, 40),
            'quantity' => fake()->numberBetween(30, 40),
            'minimum_quantity' => fake()->numberBetween(50, 60),
            // 'category_id' => Category::factory()//nop
        ];
    }
}
