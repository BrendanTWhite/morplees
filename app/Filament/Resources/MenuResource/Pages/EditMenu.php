<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use App\Filament\Resources\Pages\EditMorpleesRecord;

class EditMenu extends EditMorpleesRecord
{
    protected static string $resource = MenuResource::class;
    protected static ?string $title = 'Menu';

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            //$this->getCancelFormAction(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('edit',['record' => $this->record->id]);
    }

}
