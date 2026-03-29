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
            'galleryLocations',
        ));
    }
}
