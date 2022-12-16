<?php

namespace App\Filament\Pages;

use App\Filament\Widgets;
use App\Models;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $navigationIcon = 'bi-house-door';

    protected static ?string $slug = '';

    protected static ?string $navigationLabel = 'Home';

    protected static string $view = 'filament.pages.home';

    protected function getTitle(): string
    {
        return 'Shopping List from '
            .Models\ShoppingList::getActiveSL()->name;
    }

    protected function getActions(): array
    {
        return [

            ButtonAction::make('new')
                ->label('New List')
                ->color('secondary')
                ->url(route('filament.resources.shopping-lists.create')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\MenuButton::class,
            Widgets\PantryButton::class,
            Widgets\ShoppingButton::class,

            Widgets\RecipeButton::class,
            Widgets\ProductButton::class,
            Widgets\ShopButton::class,
        ];
    }
}
