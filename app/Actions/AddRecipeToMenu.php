<?php

namespace App\Actions;

use App\Models\{Recipe,SLRecipe,ShoppingList};
use Filament\Notifications\Notification;

class AddRecipeToMenu
{
    public function __invoke(Recipe $recipe)
    {

        // $recipe = $this->record;
        $shoppingList = ShoppingList::getActiveSL();

        SLRecipe::create([
            'recipe_id' => $recipe->id,
            'shopping_list_id' => $shoppingList->id,
        ]);
        
        Notification::make() 
            ->title($recipe->name . ' added to menu')
            ->success()
            ->send(); 

    }
}
