<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'phone',
        'address',
        'email',
    ];

    // Define relationships
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
