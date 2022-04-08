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
            ->label('New Item');
    }

}
