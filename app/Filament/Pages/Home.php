<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Actions\ButtonAction;
use App\Filament\Widgets;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $slug = '';
    protected static ?string $title = 'Flamingo Sandwiches';
    protected static ?string $navigationLabel = 'Home';

    protected static string $view = 'filament.pages.home';

    protected function getActions(): array
	{
	    return [

	        ButtonAction::make('new')
	            ->label('New List')
	            ->color('secondary')
	            ->url(route('filament.resources.shopping-lists.create')),


	        // ButtonAction::make('menu')
	        //     ->label('Menu')
	        //     ->url(route('filament.resources.menu.index')),

	        // ButtonAction::make('pantry')
	        //     ->label('Pantry')
	        //     ->url(route('filament.resources.pantry.index')),

	        // ButtonAction::make('shopping')
	        //     ->label('Shopping')
	        //     ->url(route('filament.resources.shopping.index')),

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
