<?php

namespace App\Observers;

use App\Models\ShoppingList;
use App\Models;

class ShoppingListObserver
{
    /**
     * Handle the ShoppingList "created" event.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function created(ShoppingList $shoppingList)
    {

        // Get the Product IDs of every product we should add
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

}
