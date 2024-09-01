<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BookAuthor extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book_authors';

    /**
     * Get the book associated with this pivot model.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get the author associated with this pivot model.
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
