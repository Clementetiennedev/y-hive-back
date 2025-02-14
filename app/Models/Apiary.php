<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apiary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'location',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * hives
     *
     * @return HasMany<Hive, $this>
     */
    public function hives(): HasMany
    {
        return $this->hasMany(Hive::class);
    }
}
