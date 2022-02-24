<?php

namespace App\Observers;

use App\Models\SLRecipe;
use App\Models;
use Illuminate\Support\Facades\Log;

class SLRecipeObserver
{

    public function created(SLRecipe $sLRecipe)
    {
        $sLRecipe->createSLItems();
    }

    public function updating(SLRecipe $sLRecipe)
    {
        if ($sLRecipe->isDirty('recipe_id')) {
            $sLRecipe->deleteSLItems();
        }
    }

    public function updated(SLRecipe $sLRecipe)
    {
        if ($sLRecipe->isDirty('recipe_id')) {
            $sLRecipe->createSLItems();
        }
    }

    public function deleting(SLRecipe $sLRecipe)
    {
        $sLRecipe->deleteSLItems();
    }

}
