<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryLocation extends Model
{
    protected $fillable = ['name', 'slug', 'emoji', 'description', 'sort_order', 'active'];

    protected $casts = ['active' => 'boolean'];

    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('sort_order');
    }

    public function publishedPhotos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class)
                    ->where('published', true)
                    ->orderBy('featured', 'desc')
                    ->orderBy('sort_order');
    }

    public function getPhotoCountAttribute(): int
    {
        return $this->publishedPhotos()->count();
    }

    public function getLatestPhotoDateAttribute(): ?string
    {
        return $this->publishedPhotos()->latest()->first()?->taken_at_date;
    }
}
