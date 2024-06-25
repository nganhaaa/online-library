<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $table = 'fees';
    protected $primaryKey = 'fee_id';
    public $incrementing = false; // Since fee_id is not an auto-incrementing integer
    protected $keyType = 'string';

    protected $fillable = [
        'fee_id',
        'name_fee',
        'fee',
    ];

    // Define relationships if any
}
