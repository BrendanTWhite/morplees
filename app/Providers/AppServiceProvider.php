<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

use Filament\Navigation\UserMenuItem;

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

        // Add extra items to User menu
        Filament::serving(function () {
            Filament::registerUserMenuItems([

                UserMenuItem::make()
                    ->label('Shops')
                    ->url(route('filament.resources.shops.index'))
                    ->icon('bi-shop'),

                UserMenuItem::make()
                    ->label('Products')
                    ->url(route('filament.resources.products.index'))
                    ->icon('lineawesome-apple-alt-solid'),

                UserMenuItem::make()
                    ->label('Family')
                    ->url(route('filament.resources.families.index'))
                    ->icon('heroicon-o-user-group'),

            ]);
        });

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
