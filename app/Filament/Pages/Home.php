<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Actions\ButtonAction;
use App\Filament\Widgets;
use App\Models;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $slug = '';
    protected static ?string $navigationLabel = 'Home';

    protected static string $view = 'filament.pages.home';

    protected function getTitle(): string
    {
        return Models\ShoppingList::getActiveSL()->name;
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
        ];
	}    	

}
