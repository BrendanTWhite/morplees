<?php

namespace App\Filament\Resources\SLRecipeResource\Pages;

use App\Filament\Resources\SLRecipeResource;
use Closure;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListSLRecipes extends ListRecords
{
    protected static string $resource = SLRecipeResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();

            return $resource::getUrl('view', ['record' => $record]);
        };
    }
}
