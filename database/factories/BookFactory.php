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
        $imageFiles = [
            'images/image1.jpg',
            'images/image2.jpg',
            'images/image3.jpg',
            'images/image4.jpg'
        ];

        $randomImage = $imageFiles[array_rand($imageFiles)];
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph,
            'age_group_id' => AgeGroup::inRandomOrder()->first()?->id ?? AgeGroup::factory(),
            'publisher_id' => Publisher::inRandomOrder()->first()?->id ?? Publisher::factory(),
            'publication_year' => fake()->year(),
            'available' => $available = fake()->numberBetween(1, 10),
            'quantity' => fake()->numberBetween($available, 10),
            'price' => fake()->numberBetween(1, 100),
            'image' => $randomImage,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
            $authors = Author::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $genres = Genre::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $book->authors()->attach($authors);
            $book->genres()->attach($genres);
        });
    }
}
