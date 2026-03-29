<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'role', 'group', 'bio',
        'photo', 'email', 'phone', 'phone_mobile',
        'sort_order', 'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        // Проверяем что файл реально существует
        if (!Storage::disk('public')->exists($this->photo)) {
            return null;
        }

        return Storage::disk('public')->url($this->photo);
    }

    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', $this->name);
        return collect($parts)->take(2)->map(fn($p) => strtoupper($p[0]))->implode('');
    }
}
