<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Account as Authenticatable;

class Account extends Model 
{
    use HasFactory;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';
    public $incrementing = false; // Since account_id is not an auto-incrementing integer
    protected $keyType = 'string';

    protected $fillable = [
        'account_id',
        'username',
        'password_id',
        'is_active',
    ];
}
