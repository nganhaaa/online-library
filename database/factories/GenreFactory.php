<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // List of meaningful genre names
        $genres = [
            'Science Fiction',
            'Fantasy',
            'Mystery',
            'Romance',
            'Thriller',
            'Horror',
            'Historical',
            'Biography',
            'Self-Help',
            'Non-Fiction',
        ];

        // Randomly pick a genre from the list
        $selectedGenre = $genres[array_rand($genres)];

        return [
            'name' => $selectedGenre,
        ];
    }
}
