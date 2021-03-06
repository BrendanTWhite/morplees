<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\{
	Family, User, Shop,  
	Recipe, ShoppingList,
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->command->comment('Seeding starting...');

        Family::factory()
            ->count(5) 
            ->hasUsers(3)

            ->has(
                Shop::factory()
                    ->count(5)
                    ->hasProducts(10,
                        function (array $attributes, Shop $shop) {
                            // dd($attributes); // array:3 [ "name" => "quo", "default_in_list" => true, "needed_soon" => true ]
                            return [ 'family_id' => $shop->family_id ];
                        }
                    )
            )

            ->has(
                Recipe::factory()
                    ->count(10)
                    ->hasSteps(6, 
                        function (array $attributes, Recipe $recipe) {
                            return [ 'family_id' => $recipe->family->id ];
                        })
                    ->hasIngredients(10, 
                        function (array $attributes, Recipe $recipe) {
                            return [
                                'family_id' => $recipe->family->id,
                                'product_id' => 
                                $recipe->family->shops->random()
                                ->products->random()->id
                            ];
                        }
                    )
            )

            -> has (
                $shopping_list = ShoppingList::factory()
                    ->count(20)
                    ->hasSLRecipes(7, 
                        function (array $attributes, ShoppingList $shopping_list) {
                            return [
                                'family_id' => $shopping_list->family->id,
                                'recipe_id' => 
                                $shopping_list->family->recipes->random()->id
                            ];
                        }
                    )

                )

            ->create();

            // We won't seed the SLItem table - too tricky

        $this->command->info('Seeding complete.');

    }

}
