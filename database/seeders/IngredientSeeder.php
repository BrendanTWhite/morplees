<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\Family;
use App\Models\Shop;
use App\Models\Product;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach (Family::with('shops.products:id,shop_id')->get() as $family) {

	        $this->command->info($family->name);

	        // get all the product IDs for all shops for this family
			$family_product_ids = [];
			foreach($family->shops as $this_shop) {
				$this_shop_product_ids = $this_shop->products->pluck('id')->toArray();
				$family_product_ids = array_merge($family_product_ids, $this_shop_product_ids);
			}

			// Then create the actual Ingredients, for a random product
			foreach($family->recipes as $recipe) {

				        Ingredient::factory()
				            ->count(7)
				            ->create([
							    'recipe_id' => $recipe->id,
							    'product_id' => 1,
							]);


			} // next recipe        

		} // next $family

    } // end function run()
} // end class
