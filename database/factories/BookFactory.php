<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\AgeGroup;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'age_group_id' => AgeGroup::inRandomOrder()->first()?->id ?? AgeGroup::factory(),
            'publisher_id' => Publisher::inRandomOrder()->first()?->id ?? Publisher::factory(),
            'publication_year' => $this->faker->year(),
            'available' => $this->faker->boolean(80), // 80% chance of being available
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'image' => $this->faker->imageUrl(640, 480, 'books', true),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
            // Attach authors and genres after creating a book
            $authors = Author::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $genres = Genre::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $book->authors()->attach($authors);
            $book->genres()->attach($genres);
        });
    }
}
