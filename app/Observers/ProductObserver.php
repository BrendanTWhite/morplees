<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{

    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        // Default sort order to equal the id.
        // The sort orders will change later.
        $product->shop_sort_order   = $product->id;
        $product->pantry_sort_order = $product->id;
        $product->save();
    }

}
