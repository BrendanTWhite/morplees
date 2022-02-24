<?php

namespace App\Filament\Resources\PantryResource\Pages;

use App\Filament\Resources\PantryResource;
use Filament\Resources\Pages\ListRecords;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListPantrys extends ListRecords
{
    protected static string $resource = PantryResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }

}
