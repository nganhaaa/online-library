<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $primaryKey = 'publisher_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'publisher_id',
        'publisher_name',
        'publisher_address',
        'publisher_phone',
    ];
}
