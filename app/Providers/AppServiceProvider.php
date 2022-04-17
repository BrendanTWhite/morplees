<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register custom CSS
        Filament::registerStyles([
            asset('css/custom-filament.css'),
        ]);

        // Add environment-specific colours
        switch (\App::environment()) {
            case "local":
                Filament::registerStyles([
                    asset('css/custom-filament-local.css'),
                ]);
                break;
            case "staging":
                Filament::registerStyles([
                    asset('css/custom-filament-staging.css'),
                ]);
                break;
            case "production":
                // no custom required for production
                break;
            default :
                dd(\App::environment());
        }

    }
}
