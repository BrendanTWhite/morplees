<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Resources\ShopResource;
use Filament\Resources\Pages\ListRecords;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListShops extends ListRecords
{
    protected static string $resource = ShopResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }

}
