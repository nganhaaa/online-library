<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'min_age',
        'max_age',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'age_groups';
}
