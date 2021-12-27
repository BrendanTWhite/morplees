<?php

namespace App\Filament\Resources\SLRecipeResource\Pages;

use App\Filament\Resources\SLRecipeResource;
use Filament\Resources\Pages\Page;

class ViewSLRecipe extends Page
{
    protected static string $resource = SLRecipeResource::class;

    protected static string $view = 'filament.resources.s-l-recipe-resource.pages.view-s-l-recipe';
}
