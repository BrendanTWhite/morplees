<?php

namespace App\Observers;

use App\Models\ShoppingList;
use App\Models;

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
        // Set all Shopping Lists that are already in the database
        //  to be no longer Active
        Models\ShoppingList::whereActive(TRUE)->get()
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


        if ($shoppingList->include_usually_need) {

            // Get the Product IDs of every product that should default in the list
            $product_ids = Models\Product::whereDefaultInList(TRUE)
                ->pluck('id');

            // Start with an empty array of new itmes
            $new_items = collect([]);

            // For each product ID, insert it in the new SL Items
            foreach ($product_ids as $product_id) {
                $new_items->push([
                    'product_id' => $product_id,
                    'shopping_list_id' => $shoppingList->id,
                    'family_id'  => $shoppingList->family_id,
                ]);
            }

            // and add the new items to the database
            Models\SLItem::insert($new_items->all()); 

        }


        if ($shoppingList->include_need_soon) {

            // Now the Product IDs of products with Need Soon flag set
            $product_ids = Models\Product::whereNeededSoon(TRUE)
                ->pluck('id');

            // Start with an empty array of new itmes
            $new_items = collect([]);

            // For each product ID, insert it in the new SL Items
            foreach ($product_ids as $product_id) {
                $new_items->push([
                    'product_id' => $product_id,
                    'shopping_list_id' => $shoppingList->id,
                    'family_id'  => $shoppingList->family_id,
                ]);
            }

            // and add the new items to the database
            Models\SLItem::insert($new_items->all()); 

            // Then reset the Needed Soon flag on those products
            Models\Product::whereNeededSoon(TRUE)
            ->each(function (Models\Product $product, $key) {
                $product->toggleNeededSoon();
            });

        }


    }

}
