<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingReceipt extends Model
{
    use HasFactory;

    protected $table = 'borrowing_receipt';
    protected $primaryKey = 'receipt_id';
    public $incrementing = false; // Since receipt_id is not an auto-incrementing integer
    protected $keyType = 'string';

    protected $fillable = [
        'receipt_id',
        'employee_account_id',
        'member_account_id',
        'fee_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
    ];

    // Define relationships
    public function employeeAccount()
    {
        return $this->belongsTo(Account::class, 'employee_account_id', 'account_id');
    }

    public function memberAccount()
    {
        return $this->belongsTo(Account::class, 'member_account_id', 'account_id');
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id', 'fee_id');
    }

    public function borrowedBooks()
    {
        return $this->hasMany(BorrowedBook::class, 'receipt_id', 'receipt_id');
    }
}

