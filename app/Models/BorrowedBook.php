<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    use HasFactory;

    protected $table = 'borrowed_books';
    public $incrementing = false; // Since primary key is composite
    protected $keyType = 'string';

    protected $fillable = [
        'receipt_id',
        'book_id',
        'quantity',
        'status',
    ];

    // Define relationships
    public function borrowingReceipt()
    {
        return $this->belongsTo(BorrowingReceipt::class, 'receipt_id', 'receipt_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}

