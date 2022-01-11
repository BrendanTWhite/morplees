<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use Filament\Resources\Pages\ListRecords;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListRecipes extends ListRecords
{
    protected static string $resource = RecipeResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }

}
