<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use App\Models\Recipe;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use App\Models;


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
        $recipe = $this->record;
        $shoppingList = Models\ShoppingList::getActiveSL();

        Models\SLRecipe::create([
            'recipe_id' => $recipe->id,
            'shopping_list_id' => $shoppingList->id,
        ]);
        
        Notification::make() 
            ->title($recipe->name . ' added to menu')
            ->success()
            ->send(); 
    }


}
