<?php

namespace App\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class CalendarSection extends Component
{
    public int $year;
    public int $month;

    public function mount(): void
    {
        $this->year  = (int) now()->format('Y');
        $this->month = (int) now()->format('n');
    }

    public function prevMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->year  = $date->year;
        $this->month = $date->month;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->year  = $date->year;
        $this->month = $date->month;
    }

    public function render()
    {
        $now = Carbon::create($this->year, $this->month, 1);

        $calendarEvents = Event::published()
            ->inMonth($this->year, $this->month)
            ->orderBy('starts_at')
            ->get()
            ->keyBy(fn ($e) => $e->starts_at->day);

        return view('livewire.calendar-section', compact('now', 'calendarEvents'));
    }
}
