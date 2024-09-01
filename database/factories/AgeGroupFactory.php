<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgeGroup>
 */
class AgeGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'min_age' => $minAge = fake()->numberBetween(1, 100),
            'max_age' => fake()->numberBetween($minAge, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
