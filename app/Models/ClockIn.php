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

    const TARGET_CLOCK_IN_LOCATION = [
        'lat' => 30.0493558,
        'lng' => 31.2403066,
    ];

    const MAXIMUM_CLOCK_IN_DISTANCE_KM = 2;

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
