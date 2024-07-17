<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'book_id';
    public $incrementing = false; // Since book_id is not an auto-incrementing integer
    protected $keyType = 'string';
    protected $fillable = [
        'book_id',
        'book_name',
        'age_group_id',
        'publisher_id',
        'publication_year',
        'available',
        'quantity',
        'price',
        'image'
    ];

    // Define the relationships
    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class, 'age_group_id', 'age_group_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'publisher_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'author_id')
                ->using(BookAuthor::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id')
                ->using(BookGenre::class);
    }
}
