<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeocodeCache extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'bbox_min_lat',
        'bbox_max_lat',
        'bbox_min_lng',
        'bbox_max_lng',
        'city_id',
        'nominatim_response',
    ];

    protected $casts = [
        'bbox_min_lat'       => 'decimal:4',
        'bbox_max_lat'       => 'decimal:4',
        'bbox_min_lng'       => 'decimal:4',
        'bbox_max_lng'       => 'decimal:4',
        'nominatim_response' => 'array',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Найти запись в кэше по координатам точки
     */
    public static function findByPoint(float $lat, float $lng): ?self
    {
        return static::where('bbox_min_lat', '<=', $lat)
            ->where('bbox_max_lat', '>=', $lat)
            ->where('bbox_min_lng', '<=', $lng)
            ->where('bbox_max_lng', '>=', $lng)
            ->first();
    }
}
