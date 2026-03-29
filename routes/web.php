<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JubileeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

// ── Public ──────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery');
Route::post('/kontakt', [ContactController::class, 'store'])->name('contact.store');

// ── Static-ish pages (Blade views, no controller needed) ───────────────────
Route::get('/wer-macht-was', [TeamController::class, 'index'])->name('team');
Route::get('/vereinsjubilaeum', [JubileeController::class, 'index'])->name('vereinsjubilaeum');
Route::view('/vereinsleben', 'pages.vereinsleben')->name('vereinsleben');
Route::view('/vereinshuette', 'pages.vereinshuette')->name('vereinshuette');
Route::view('/vereinschronik', 'pages.vereinschronik')->name('vereinschronik');
Route::view('/impressum', 'pages.impressum')->name('impressum');
Route::view('/datenschutz', 'pages.datenschutz')->name('datenschutz');
