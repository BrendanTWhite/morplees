<?php

namespace App\Observers;

use App\Models\SLRecipe;
use App\Models;
use Illuminate\Support\Facades\Log;

class SLRecipeObserver
{

    /**
     * Handle the SLRecipe "created" event.
     *
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return void
     */
    public function created(SLRecipe $sLRecipe)
    {

        // Get the Product IDs of the recipe's ingredients' products
        $recipe = $sLRecipe->recipe;
        $product_ids = $recipe->products
            ->pluck('id');

        // Start with an empty array of new itmes
        $new_items = collect([]);

        // For each product ID, insert it in the new SL Items
        foreach ($product_ids as $product_id) {
            $new_items->push([
                'product_id'       => $product_id,
                'shopping_list_id' => $sLRecipe->shopping_list_id,
                'family_id'        => $sLRecipe->family_id,
                's_l_recipe_id'    => $sLRecipe->id,
            ]);
        }

        // and add the new items to the database
        Models\SLItem::insert($new_items->all()); 

    }

    /**
     * Handle the SLRecipe "deleting" event.
     *
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return void
     */
    public function deleting(SLRecipe $sLRecipe)
    {
        // before we delete the SL Recipe,
        // first delete the related SL Items

        $sLRecipe->s_l_items->each(function ($item, $key) {
            Models\SLItem::destroy($item->id);
        });
    }

}
