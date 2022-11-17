<?php

namespace App\Filament\Resources\ShoppingListResource\Pages;

use App\Filament\Pages\Home;
use App\Filament\Resources;
use App\Filament\Resources\Pages\CreateMorpleesRecord;
use Filament\Pages\Actions\Action;

class CreateShoppingList extends CreateMorpleesRecord
{
    protected static string $resource = Resources\ShoppingListResource::class;

    protected static ?string $title = 'Create New Shopping List?';

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            //$this->getCreateAndCreateAnotherFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Yes!');
    }

    protected function getRedirectUrl(): string
    {
        return Home::getUrl();
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->url(Home::getUrl());
    }
}
