<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\ButtonAction;

class CreateMenu extends CreateRecord
{
    protected static string $resource = MenuResource::class;
    protected static ?string $title = 'Add Recipe to Menu';


    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    protected function getCreateFormAction(): ButtonAction
    {
        return parent::getCreateFormAction()
            ->label('Add');
    }

    protected function getCreateAndCreateAnotherFormAction(): ButtonAction
    {
        return parent::getCreateAndCreateAnotherFormAction()
            ->label('Add & add another');
    }

}
