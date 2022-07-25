<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources;
use Filament\Resources\Pages\ListRecords;

use Filament\Pages\Actions\ButtonAction;
use Closure;
use App\Models;
use Filament\Pages\Actions\Action;

class ListMenus extends ListRecords
{
    protected static string $resource = Resources\MenuResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Models\SLRecipe $record): ?string {
            return Resources\RecipeResource::getUrl('view', ['record' => $record->recipe]);
        };
    }
 
    protected function getActions(): array
    {
        return [
            Action::make('add_recipe')
                ->label('Add Recipe')
                ->url(route('filament.resources.menu.create')),
        ];
    }       

    protected function getTableEmptyStateIcon(): ?string 
    {
        return 'heroicon-o-emoji-sad';
    }
 
    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No Recipes Yet.';
    }
 
    protected function getTableEmptyStateActions(): array
    {
        return [
            \Filament\Tables\Actions\Action::make('create')
                ->label('Add a recipe?')
                ->url(route('filament.resources.menu.create'))
                ->icon('heroicon-o-plus'),
        ];
    } 

}
