<?php

namespace App\Filament\Resources\PantryResource\Pages;

use App\Filament\Resources\PantryResource;
use Filament\Resources\Pages\ListRecords;

class ListPantrys extends ListRecords
{
    protected static string $resource = PantryResource::class;

    protected function getActions(): array
    {
        return [
        	//
        ];
    }

}
