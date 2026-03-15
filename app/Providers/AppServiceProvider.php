<?php

namespace App\Providers;

use App\Services\ExifExtractorService;
use App\Services\GeocoderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExifExtractorService::class);
        $this->app->singleton(GeocoderService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
