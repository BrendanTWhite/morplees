<?php

namespace App\Filament\Resources\PantryResource\Pages;

use App\Filament\Resources\PantryResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListPantrys extends ListRecords
{
    protected static string $resource = PantryResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('add_item')
                ->label('Add Item')
                ->url(route('filament.resources.pantry.create')),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
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
