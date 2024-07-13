<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'author_id';
    public $incrementing = false; // Since author_id is not an auto-incrementing integer
    protected $keyType = 'string';

    protected $fillable = [
        'author_id',
        'first_name',
        'last_name',
        'nationality',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_author', 'author_id', 'book_id')
                ->using(BookAuthor::class);
    }
}
