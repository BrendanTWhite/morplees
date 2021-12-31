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
                    ->hasProducts(10)
            )

            ->has(
                $recipe = Recipe::factory()
                    ->count(10)
                    ->hasSteps(6)
                    ->hasIngredients(10, 
                        function (array $attributes, Recipe $recipe) {
                            return [
                                'product_id' => 
                                $recipe->family->shops->random()
                                ->products->random()->id
                            ];
                        }
                    )
            )

            -> has (
                $shopping_list = ShoppingList::factory()
                    ->count(10)
                    ->state(new Sequence(
                        ['override_name' => null],
                        ['override_name' => null],
                        ['override_name' => null],
                        ['override_name' => 'custom list name'],
                    ))            

                    ->hasSLRecipes(10, 
                        function (array $attributes, ShoppingList $shopping_list) {
                            return [
                                'recipe_id' => 
                                $shopping_list->family->recipes->random()->id
                            ];
                        }
                    )

                    // ->hasSLItems(10, 
                    //     function (array $attributes, ShoppingList $shopping_list) {
                    //         return [
                    //             'product_id' => 
                    //             $shopping_list->family->shops->random()
                    //             ->products->random()->id
                    //         ];
                    //     }
                    // )

                )

            ->create();


        // Reset the details for Brendan
        $brendan = User::find(7);
        $brendan->name = 'Brendan White';
        $brendan->email = 'brendan@thespia.com';
        $brendan->password = 'dingodingo'; // gets hashed by the setPasswordAttribute mutator
        $brendan->save();

        $this->command->info('Seeding complete.');

    }

}
