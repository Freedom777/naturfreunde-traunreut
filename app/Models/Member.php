<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['name', 'year_joined', 'active'];

    protected $casts = [
        'year_joined' => 'integer',
        'active'      => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    /**
     * Количество лет членства в текущем году
     */
    public function getYearsAttribute(): int
    {
        return (int) date('Y') - $this->year_joined;
    }

    /**
     * Является ли текущий год юбилейным
     */
    public function getIsJubileeAttribute(): bool
    {
        return in_array($this->years, config('naturfreunde.jubilee_years'));
    }

    /**
     * Scope — только юбиляры текущего года
     */
    public function scopeJubilees(Builder $query): Builder
    {
        $currentYear   = (int) date('Y');
        $jubileeYears  = config('naturfreunde.jubilee_years');

        $joinedYears = array_map(
            fn (int $y) => $currentYear - $y,
            $jubileeYears
        );

        return $query->whereIn('year_joined', $joinedYears);
    }
}
