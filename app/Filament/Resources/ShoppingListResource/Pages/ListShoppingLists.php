<?php

namespace App\Filament\Resources\ShoppingListResource\Pages;

use App\Filament\Resources\ShoppingListResource;
use Filament\Resources\Pages\ListRecords;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListShoppingLists extends ListRecords
{
    protected static string $resource = ShoppingListResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }

}
