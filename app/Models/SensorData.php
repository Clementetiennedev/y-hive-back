<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SensorData extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sensor_id',
        'model_type',
        'model_id',
        'data_type',
        'value',
        'recorded_at',
        'anomaly',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
