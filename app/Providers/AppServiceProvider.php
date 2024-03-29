<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        \URL::forceScheme('https');

        // Add extra items to User menu
        Filament::serving(function () {
            Filament::registerUserMenuItems([

                'account' => UserMenuItem::make()->url(route('profile.edit')),

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
                    ->url(route('filament.resources.families.view', ['record' => Auth::user()->family_id]))
                    ->icon('heroicon-o-user-group'),

            ]);
        });

        // Register custom CSS
        Filament::registerStyles([
            asset('css/custom-filament.css'),
        ]);

        // Add environment-specific colours
        switch (\App::environment()) {
            case 'local':
                Filament::registerStyles([
                    asset('css/custom-filament-local.css'),
                ]);
                break;
            case 'staging':
                Filament::registerStyles([
                    asset('css/custom-filament-staging.css'),
                ]);
                break;
            case 'testing':
                // no custom required for testing
                break;
            case 'production':
                // no custom required for production
                break;
            default:
                dd('Unknown Environment in app/Providers/AppServiceProvider: '.\App::environment());
        }
    }
}
