<?php

namespace App\Filament\Resources\ShoppingListResource\Pages;

use App\Filament\Resources;
use App\Filament\Resources\Pages\CreateMorpleesRecord;
use Filament\Pages\Actions\ButtonAction;
use App\Filament\Pages\Home;

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

    protected function getCreateFormAction(): ButtonAction
    {
        return parent::getCreateFormAction()
            ->label('Yes!');
    }

	protected function getRedirectUrl(): string
	    {
	    	return Home::getUrl();
	    }
}
