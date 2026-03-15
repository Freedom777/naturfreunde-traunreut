<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'gallery_location_id',
        'city_id',
        'path',
        'caption',
        'taken_at_date',
        'sort_order',
        'published',
    ];

    protected $casts = [
        'taken_at_date' => 'date',
        'published'     => 'boolean',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(GalleryLocation::class, 'gallery_location_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    /**
     * Определить широкое ли фото по соотношению сторон
     */
    public function getIsWideAttribute(): bool
    {
        $fullPath = Storage::path($this->path);

        if (!file_exists($fullPath)) {
            return false;
        }

        [$width, $height] = getimagesize($fullPath);

        return $height > 0 && ($width / $height) >= 1.5;
    }
}
