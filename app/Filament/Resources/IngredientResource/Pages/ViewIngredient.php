<?php

namespace App\Filament\Resources\IngredientResource\Pages;

use App\Filament\Resources\IngredientResource;
use Filament\Resources\Pages\Page;

class ViewIngredient extends Page
{
    protected static string $resource = IngredientResource::class;

    protected static string $view = 'filament.resources.ingredient-resource.pages.view-ingredient';
}
