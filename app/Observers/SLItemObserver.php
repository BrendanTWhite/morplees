<?php

namespace App\Observers;

use App\Models\SLItem;

class SLItemObserver
{
    /**
     * Handle the SLItem "created" event.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return void
     */
    public function created(SLItem $sLItem)
    {
        //
    }

    /**
     * Handle the SLItem "updated" event.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return void
     */
    public function updated(SLItem $sLItem)
    {
        //
    }

    /**
     * Handle the SLItem "deleted" event.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return void
     */
    public function deleted(SLItem $sLItem)
    {
        //
    }

    /**
     * Handle the SLItem "restored" event.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return void
     */
    public function restored(SLItem $sLItem)
    {
        //
    }

    /**
     * Handle the SLItem "force deleted" event.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return void
     */
    public function forceDeleted(SLItem $sLItem)
    {
        //
    }
}
