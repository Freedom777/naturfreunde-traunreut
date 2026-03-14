<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'gallery_location_id', 'path', 'caption',
        'taken_at_date', 'featured', 'sort_order', 'published',
    ];

    protected $casts = [
        'featured'  => 'boolean',
        'published' => 'boolean',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(GalleryLocation::class, 'gallery_location_id');
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        // If using Spatie MediaLibrary or Intervention Image for thumbnails,
        // swap this out. For now returns the same URL.
        return Storage::url($this->path);
    }
}
