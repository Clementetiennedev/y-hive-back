<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hive extends Model
{
    /**
     * @use HasFactory<\Database\Factories\HiveFactory>
     */
    use hasFactory;

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

    protected static function booted()
    {
        static::addGlobalScope('belongsToUser', function (Builder $builder) {
            if (auth()->check()) {
                $builder->whereHas('apiary', function (Builder $builder) {
                    $builder->where('user_id', auth()->id());
                });
            }
        });
    }

    /**
     * apiary
     *
     * @return BelongsTo<Apiary, $this>
     */
    public function apiary(): BelongsTo
    {
        return $this->belongsTo(Apiary::class);
    }
}
