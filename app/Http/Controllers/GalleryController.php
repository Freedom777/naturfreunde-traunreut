<?php

namespace App\Http\Controllers;

use App\Models\GalleryLocation;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $locations = GalleryLocation::where('active', true)
            ->orderBy('sort_order')
            ->with(['publishedPhotos'])
            ->get();

        return view('pages.gallery', compact('locations'));
    }
}
