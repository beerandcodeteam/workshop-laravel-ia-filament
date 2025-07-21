<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('langFlow', function () {
            return Http::withHeaders([
                'x-api-key' => config('langflow.api_key'),
            ])->baseUrl(config('langflow.url'));
        });

    }
}
