<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use App\Models\Recipe;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions;


class ViewRecipe extends ViewRecord
{
    protected static string $resource = RecipeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('add_to_menu')->label('Add to Menu')
            ->action('addToMenu'),

            Actions\EditAction::make(),
        ];
    }
     
    public function addToMenu(): void
    {

        $addRecipeToMenu = new \App\Actions\AddRecipeToMenu;
        $addRecipeToMenu($this->record);

    }


}
