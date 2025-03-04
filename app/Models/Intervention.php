<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    /**
     * @use HasFactory<\Database\Factories\InterventionFactory>
     */
    use hasFactory;

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'model_id',
        'model_type',
        'type',
        'amount',
        'date',
        'observations',
        'attachment_path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
