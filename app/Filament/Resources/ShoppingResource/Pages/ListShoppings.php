<?php

namespace App\Filament\Resources\ShoppingResource\Pages;

use App\Filament\Resources\ShoppingResource;
use Filament\Resources\Pages\ListRecords;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListShoppings extends ListRecords
{
    protected static string $resource = ShoppingResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }

}
