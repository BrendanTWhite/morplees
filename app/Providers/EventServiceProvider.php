<?php

namespace App\Providers;

use App\Listeners\RemoveFamilyIdFromSession;
use App\Listeners\SetFamilyIdInSession;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],



        // Laravel 7 method - works but shouldn't
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\SetFamilyIdInSession',
        ],

        // Laravel 8 method - should work but doesn't
        // Illuminate\Auth\Events\Login::class => [
        //     App\Listeners\SetFamilyIdInSession::class,
        // ],



        // Laravel 7 method - works but shouldn't
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\RemoveFamilyIdFromSession',
        ],
    
        // Laravel 8 method - should work but doesn't
        // Logout::class => [
        //     RemoveFamilyIdFromSession::class,
        // ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
