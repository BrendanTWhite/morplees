<?php

namespace App\Filament\Resources\PantryResource\Pages;

use App\Filament\Resources\PantryResource;
use App\Filament\Resources\Pages\ListMorpleesRecords;

class ListPantrys extends ListMorpleesRecords
{
    protected static string $resource = PantryResource::class;

    protected function getActions(): array
    {
        return [
        	//
        ];
    }

}
