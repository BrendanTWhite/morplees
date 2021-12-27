<?php

namespace App\Filament\Resources\ShoppingListResource\Pages;

use App\Filament\Resources\ShoppingListResource;
use Filament\Resources\Pages\Page;

class ViewShoppingList extends Page
{
    protected static string $resource = ShoppingListResource::class;

    protected static string $view = 'filament.resources.shopping-list-resource.pages.view-shopping-list';
}
