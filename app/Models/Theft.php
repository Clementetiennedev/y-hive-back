<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theft extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'hive_id',
        'user_id',
        'reported_at',
        'last_known_location',
        'picture_path',
        'details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
