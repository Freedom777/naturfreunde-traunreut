<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\GalleryLocation;
use Carbon\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Upcoming events for the cards section (next 6)
        $upcomingEvents = Event::published()->upcoming()->limit(6)->get();

        // Calendar: current month events
        $now = Carbon::now();
        $calendarEvents = Event::published()
            ->inMonth($now->year, $now->month)
            ->orderBy('starts_at')
            ->get()
            ->keyBy(fn($e) => $e->starts_at->day);

        // Gallery locations with cover photo
        $galleryLocations = GalleryLocation::where('active', true)
            ->orderBy('sort_order')
            ->with(['publishedPhotos' => fn($q) => $q->limit(8)])
            ->get();

        return view('pages.home', compact(
            'upcomingEvents',
            'calendarEvents',
            'galleryLocations',
            'now',
        ));
    }
}
