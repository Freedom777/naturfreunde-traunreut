<?php

namespace App\Http\Controllers;

use App\Models\GalleryLocation;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleryLocations = GalleryLocation::where('published', true)
            ->with(['publishedPhotos', 'city.state', 'coverPhoto'])
            ->withCount(['publishedPhotos as published_photos_count'])
            ->latest('date')
            ->get();

        return view('pages.gallery', compact('galleryLocations'));
    }
}
