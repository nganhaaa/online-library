<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'author_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'author_id',
        'first_name',
        'last_name',
        'nationality',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'author_id');
    }
}
