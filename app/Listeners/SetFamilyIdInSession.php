<?php

namespace App\Listeners;

class SetFamilyIdInSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user->family_id) {
            session()->put('family_id', $event->user->family_id);
        }
    }
}
