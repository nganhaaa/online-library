<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'receipt_details';

    /**
     * The primary key associated with the table.
     *
     * @var array
     */
    protected $primaryKey = ['receipt_id', 'book_id'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'receipt_id',
        'book_id',
        'quantity',
        'status',
    ];

    /**
     * Get the borrow receipt associated with the receipt detail.
     */
    public function borrowReceipt()
    {
        return $this->belongsTo(BorrowReceipt::class, 'receipt_id');
    }

    /**
     * Get the book associated with the receipt detail.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
