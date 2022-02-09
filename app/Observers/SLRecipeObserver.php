<?php

namespace App\Observers;

use App\Models\SLRecipe;

class SLRecipeObserver
{
    
    /**
     * Handle the SLRecipe "created" event.
     *
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return void
     */
    public function created(SLRecipe $sLRecipe)
    {
        //
    }

    /**
     * Handle the SLRecipe "deleting" event.
     *
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return void
     */
    public function deleting(SLRecipe $sLRecipe)
    {
        //
    }

}
