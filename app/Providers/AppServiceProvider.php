<?php

namespace App\Providers;

use App\Services\DirectionsApiInterface;
use App\Services\GoogleDirectionsApi;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DirectionsApiInterface::class, GoogleDirectionsApi::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
