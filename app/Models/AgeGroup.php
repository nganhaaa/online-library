<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    use HasFactory;

    protected $table = 'age_groups';
    protected $primaryKey = 'age_group_id';
    public $incrementing = false; // Since age_group_id is not an auto-incrementing integer
    protected $keyType = 'string';

    protected $fillable = [
        'age_group_id',
        'age_group_name',
        'min_age',
        'max_age',
    ];
}
