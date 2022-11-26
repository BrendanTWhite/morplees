<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Recipe;
use App\Models\Shop;
use App\Models\ShoppingList;
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
        $this->command->comment('Seeding starting...');

        Family::factory()
            ->count(5)
            ->hasUsers(3)

            ->has(
                Recipe::factory()
                    ->count(10)
                    ->hasSteps(6,
                        function (array $attributes, Recipe $recipe) {
                            return ['family_id' => $recipe->family_id];
                        })
                    ->hasIngredients(10,
                        function (array $attributes, Recipe $recipe) {
                            return [
                                'family_id' => $recipe->family_id,
                                'product_id' => $recipe->family
                                    ->products->random()->id,
                            ];
                        }
                    )
            )

            ->has(
                $shopping_list = ShoppingList::factory()
                    ->count(20)
                    ->hasSLRecipes(7,
                        function (array $attributes, ShoppingList $shopping_list) {
                            return [
                                'family_id' => $shopping_list->family_id,
                                'recipe_id' => $shopping_list->family->recipes->random()->id,
                            ];
                        }
                    )
            )

            ->hasProducts(5) // these ones have no Shop

            ->create();

        // We won't seed the SLItem table - too tricky

        $this->command->info('Seeding complete.');
    }
}
