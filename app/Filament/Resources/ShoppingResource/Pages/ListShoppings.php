<?php

namespace App\Filament\Resources\ShoppingResource\Pages;

use App\Filament\Resources\ShoppingResource;
use Filament\Resources\Pages\ListRecords;

class ListShoppings extends ListRecords
{
    protected static string $resource = ShoppingResource::class;

    protected function getActions(): array
    {
        return [
            //
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
