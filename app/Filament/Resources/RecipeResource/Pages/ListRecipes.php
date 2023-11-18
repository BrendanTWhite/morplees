<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Actions\AddRecipeToMenu;
use App\Filament\Resources\RecipeResource;
use App\Models\Recipe;
use Closure;
use Filament\Resources\Pages\ListRecords;
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


    public function addToMenu(Recipe $record) {
        $add = new AddRecipeToMenu;
        $add($record);    
    }
                
}
