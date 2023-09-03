<?php

namespace App\Actions;

use App\Models\Recipe;
use App\Models\SLRecipe;
use Illuminate\Support\Facades\Log;

class AddRecipeToMenu
{
    public function __invoke(Recipe $recipe, ?SLRecipe $sLRecipe)
    {

        Log::info('batman');

    }
}
