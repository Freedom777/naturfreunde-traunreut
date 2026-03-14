<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'location', 'category',
        'starts_at', 'ends_at', 'all_day', 'guests_welcome', 'published',
    ];

    protected $casts = [
        'starts_at'       => 'datetime',
        'ends_at'         => 'datetime',
        'all_day'         => 'boolean',
        'guests_welcome'  => 'boolean',
        'published'       => 'boolean',
    ];

    // ── Scopes ──────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('starts_at', '>=', now()->startOfDay())
                     ->orderBy('starts_at');
    }

    public function scopeInMonth(Builder $query, int $year, int $month): Builder
    {
        return $query->whereYear('starts_at', $year)
                     ->whereMonth('starts_at', $month);
    }

    // ── Accessors ────────────────────────────────────────────

    public function getCategoryEmojiAttribute(): string
    {
        return match ($this->category) {
            'wanderung'   => '🥾',
            'sport'       => '🎯',
            'umwelt'      => '♻️',
            'gemeinschaft'=> '☕',
            'kultur'      => '🎭',
            default       => '📌',
        };
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'wanderung'   => 'Wanderung',
            'sport'       => 'Sport',
            'umwelt'      => 'Umwelt',
            'gemeinschaft'=> 'Gemeinschaft',
            'kultur'      => 'Kultur',
            default       => 'Sonstiges',
        };
    }

    /**
     * Build Google Calendar add-event URL
     */
    public function getGoogleCalendarUrlAttribute(): string
    {
        $start = $this->all_day
            ? $this->starts_at->format('Ymd')
            : $this->starts_at->utc()->format('Ymd\THis\Z');

        $end = $this->ends_at
            ? ($this->all_day
                ? $this->ends_at->format('Ymd')
                : $this->ends_at->utc()->format('Ymd\THis\Z'))
            : ($this->all_day
                ? $this->starts_at->addDay()->format('Ymd')
                : $this->starts_at->addHours(2)->utc()->format('Ymd\THis\Z'));

        return 'https://calendar.google.com/calendar/render?' . http_build_query(array_filter([
            'action'   => 'TEMPLATE',
            'text'     => $this->title . ' – NaturFreunde Traunreut',
            'dates'    => $start . '/' . $end,
            'details'  => $this->description,
            'location' => $this->location,
        ]));
    }

    /**
     * Date badge color by category
     */
    public function getDateColorAttribute(): string
    {
        return match ($this->category) {
            'wanderung'   => '#4e8b2c',
            'sport'       => '#5a7a2a',
            'umwelt'      => '#3d7020',
            'gemeinschaft'=> '#c8861a',
            'kultur'      => '#6b4c8a',
            default       => '#2f5c1a',
        };
    }
}
