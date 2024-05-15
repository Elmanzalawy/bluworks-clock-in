<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClockIn extends Model
{
    use HasFactory;

    const CREATED_AT = 'timestamp';
    const UPDATED_AT = null;

    protected $fillable = [
        'worker_id',
        'latitude',
        'longitude',
        'timestamp',
    ];

    /**
     * Return worker relation
     *
     * @return BelongsTo
     */
    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }
}
