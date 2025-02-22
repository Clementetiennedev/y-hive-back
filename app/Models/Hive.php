<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hive extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'apiary_id',
        'name',
        'type',
        'installation_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function apiary(): BelongsTo
    {
        return $this->belongsTo(Apiary::class);
    }
}
