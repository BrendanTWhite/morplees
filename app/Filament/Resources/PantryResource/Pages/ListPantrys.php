<?php

namespace App\Filament\Resources\PantryResource\Pages;

use App\Filament\Resources\PantryResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\ButtonAction;

class ListPantrys extends ListRecords
{
    protected static string $resource = PantryResource::class;


    protected function getCreateAction(): ButtonAction
    {
        return parent::getCreateAction()
            ->label('Add Item');
    }

    protected function getTableEmptyStateIcon(): ?string 
    {
        return 'heroicon-o-emoji-sad';
    }
 
    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No Items Yet.';
    }
 
    protected function getTableEmptyStateActions(): array
    {
        return [
            \Filament\Tables\Actions\Action::make('create')
                ->label('Add an item?')
                ->url(route('filament.resources.pantry.create'))
                ->icon('heroicon-o-plus'),
        ];
    } 


}
