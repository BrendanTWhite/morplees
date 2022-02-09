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
     * Handle the SLItem "deleted" event.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return void
     */
    public function deleted(SLItem $sLItem)
    {
        //
    }

}
