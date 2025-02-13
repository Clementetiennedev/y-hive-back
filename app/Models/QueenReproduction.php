<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueenReproduction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'hive_id',
        'reproduction_date',
        'new_colony_created',
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
