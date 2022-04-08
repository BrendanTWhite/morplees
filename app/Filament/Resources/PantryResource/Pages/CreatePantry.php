<?php

namespace App\Filament\Resources\PantryResource\Pages;

use App\Filament\Resources\PantryResource;
use App\Filament\Resources\Pages\CreateMorpleesRecord;
use Filament\Pages\Actions\ButtonAction;

class CreatePantry extends CreateMorpleesRecord
{
    protected static string $resource = PantryResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

 	protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getCreateFormAction(): ButtonAction
    {
        return parent::getCreateFormAction()
            ->label('Add');
    }

}
