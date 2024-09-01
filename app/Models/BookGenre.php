<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BookGenre extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book_genres';

    /**
     * Get the book associated with this pivot model.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get the genre associated with this pivot model.
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
