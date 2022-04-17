<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources;
use Filament\Resources\Pages\ListRecords;

use Filament\Pages\Actions\ButtonAction;
use Closure;
use App\Models;

class ListMenus extends ListRecords
{
    protected static string $resource = Resources\MenuResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Models\SLRecipe $record): ?string {
            return Resources\RecipeResource::getUrl('view', ['record' => $record->recipe]);
        };
    }

    protected function getCreateAction(): ButtonAction
    {
        return parent::getCreateAction()
            ->label('Add Recipe');
    }

}
