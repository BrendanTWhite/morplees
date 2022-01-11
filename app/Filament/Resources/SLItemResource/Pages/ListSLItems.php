<?php

namespace App\Filament\Resources\SLItemResource\Pages;

use App\Filament\Resources\SLItemResource;
use Filament\Resources\Pages\ListRecords;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListSLItems extends ListRecords
{
    protected static string $resource = SLItemResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }

}
