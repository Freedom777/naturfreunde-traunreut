<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryLocation extends Model
{
    protected $fillable = [
        'city_id',
        'name',
        'description',
        'date',
        'cover_photo_id',
        'published',
    ];

    protected $casts = [
        'date'      => 'date',
        'published' => 'boolean',
    ];

    // ── Relations ────────────────────────────────────────────

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function coverPhoto(): BelongsTo
    {
        return $this->belongsTo(GalleryPhoto::class, 'cover_photo_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('sort_order');
    }

    public function publishedPhotos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class)
            ->where('published', true)
            ->orderBy('sort_order');
    }

    // ── Scopes ───────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    // ── Accessors ────────────────────────────────────────────

    public function getStateAttribute(): ?State
    {
        return $this->city?->state;
    }
}
