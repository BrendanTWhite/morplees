<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
	    $this->call([
	        FamilySeeder::class,
	        //UserSeeder::class,
	        ShopSeeder::class,
	        ProductSeeder::class,
	        RecipeSeeder::class,
	        StepSeeder::class,
	        IngredientSeeder::class,
	        ShoppingListSeeder::class,
	        SLRecipeSeeder::class,
	        SLItemSeeder::class,
	    ]);
    }
}
