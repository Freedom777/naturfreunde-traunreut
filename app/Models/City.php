<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'state_code',
        'name',
        'zip_code',
        'is_district',
    ];

    protected $casts = [
        'zip_code'    => 'integer',
        'is_district' => 'boolean',
    ];

    public $timestamps = false;

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_code', 'code');
    }

    public function galleryLocations(): HasMany
    {
        return $this->hasMany(GalleryLocation::class);
    }

    public function galleryPhotos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class);
    }
}
