<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// ── Public ──────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery');
Route::post('/kontakt', [ContactController::class, 'store'])->name('contact.store');

// ── Static-ish pages (Blade views, no controller needed) ───────────────────
Route::view('/wer-macht-was', 'pages.team')->name('team');
Route::view('/vereinsleben', 'pages.vereinsleben')->name('vereinsleben');
Route::view('/vereinshuette', 'pages.vereinshuette')->name('vereinshuette');
Route::view('/vereinschronik', 'pages.vereinschronik')->name('vereinschronik');
Route::view('/impressum', 'pages.impressum')->name('impressum');
Route::view('/datenschutz', 'pages.datenschutz')->name('datenschutz');
