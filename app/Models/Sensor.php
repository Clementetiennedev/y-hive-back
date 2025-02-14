<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'model_type',
        'model_id',
        'name',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
