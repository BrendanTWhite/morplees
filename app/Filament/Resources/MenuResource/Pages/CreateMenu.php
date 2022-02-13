<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use App\Filament\Resources\Pages\CreateMorpleesRecord;

class CreateMenu extends CreateMorpleesRecord
{
    protected static string $resource = MenuResource::class;
    protected static ?string $title = 'Create Shopping List';



    protected function getFormActions(): array
    {
        return [
            $this->getCreateButtonFormAction(),
            //$this->getCreateAndCreateAnotherButtonFormAction(),
            $this->getCancelButtonFormAction(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return static::$resource::getUrl('index');
    }

}
