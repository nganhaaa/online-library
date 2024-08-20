<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'age_group_id',
        'publisher_id',
        'publication_year',
        'available',
        'quantity',
        'price',
        'image',
    ];

    /**
     * Get the age group associated with the book.
     */
    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class, 'age_group_id');
    }

    /**
     * Get the publisher associated with the book.
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    // Add other relationships or methods as needed

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'book_id', 'author_id')
                ->using(BookAuthor::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres', 'book_id', 'genre_id')
                ->using(BookGenre::class);
    }
}
