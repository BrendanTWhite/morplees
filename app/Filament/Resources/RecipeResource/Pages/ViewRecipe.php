<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use Filament\Resources\Pages\Page;

class ViewRecipe extends Page
{
    protected static string $resource = RecipeResource::class;

    protected static string $view = 'filament.resources.recipe-resource.pages.view-recipe';
}
