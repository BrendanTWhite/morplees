<?php

namespace App\Observers;

use App\Models;
use App\Models\ShoppingList;

class ShoppingListObserver
{
    /**
     * Handle the ShoppingList "creating" event.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function creating(ShoppingList $shoppingList)
    {
        // Save old active shopping list ID (if there is one)
        $previous_list = Models\ShoppingList::whereActive(true)->first();
        if ($previous_list) {
            session()->now('previous_list_id',
                $previous_list->id);
        }

        // Set all Shopping Lists that are already in the database
        //  to be no longer Active
        Models\ShoppingList::whereActive(true)->get()
        ->each(function (Models\ShoppingList $other_shopping_list, $key) {
            $other_shopping_list->toggleActive();
        });
    }

    /**
     * Handle the ShoppingList "created" event.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function created(ShoppingList $shoppingList)
    {
        // If the user wanted to copy recipes from the previous list...
        if ($shoppingList->copy_recipes) {
            /// ... and there actually IS a previous list...
            if ($previous_list = Models\ShoppingList::find(session('previous_list_id'))) {
                // ... then loop through the SLRecipes for the previous list
                // and create a new SLR for the same recipe in the new list
                foreach ($previous_list->s_l_recipes as $oldSLR) {
                    Models\SLRecipe::create([
                        'shopping_list_id' => $shoppingList->id,
                        'recipe_id' => $oldSLR->recipe_id,
                    ]);
                }
            }
        }
        // and in any case, clean up the session
        session()->forget('previous_list_id');

        if ($shoppingList->include_usually_need) {
            // Get the Product IDs of every product that should default in the list
            $product_ids = Models\Product::whereDefaultInList(true)
                ->pluck('id');

            // Start with an empty array of new itmes
            $new_items = collect([]);

            // For each product ID, insert it in the new SL Items
            foreach ($product_ids as $product_id) {
                $new_items->push([
                    'product_id' => $product_id,
                    'shopping_list_id' => $shoppingList->id,
                    'family_id' => $shoppingList->family_id,
                ]);
            }

            // and add the new items to the database
            Models\SLItem::insert($new_items->all());
        }

        if ($shoppingList->include_need_soon) {
            // Now the Product IDs of products with Need Soon flag set
            $product_ids = Models\Product::whereNeededSoon(true)
                ->pluck('id');

            // Start with an empty array of new itmes
            $new_items = collect([]);

            // For each product ID, insert it in the new SL Items
            foreach ($product_ids as $product_id) {
                $new_items->push([
                    'product_id' => $product_id,
                    'shopping_list_id' => $shoppingList->id,
                    'family_id' => $shoppingList->family_id,
                ]);
            }

            // and add the new items to the database
            Models\SLItem::insert($new_items->all());

            // Then reset the Needed Soon flag on those products
            Models\Product::whereNeededSoon(true)
            ->each(function (Models\Product $product, $key) {
                $product->toggleNeededSoon();
            });
        }
    }
}
