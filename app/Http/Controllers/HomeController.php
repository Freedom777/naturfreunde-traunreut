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
        $upcomingEvents = Event::published()->upcoming()->limit(6)->get();

        $now = Carbon::now();
        $calendarEvents = Event::published()
            ->inMonth($now->year, $now->month)
            ->orderBy('starts_at')
            ->get()
            ->keyBy(fn ($e) => $e->starts_at->day);

        $galleryLocations = GalleryLocation::where('published', true)
            ->with([
                'publishedPhotos',
                'city.state',
                'coverPhoto',
            ])
            ->latest('date')
            ->limit(6)
            ->get();

        return view('pages.home', compact(
            'upcomingEvents',
            'calendarEvents',
            'galleryLocations',
            'now',
        ));
    }
}
