<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Family;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;
 
class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
                    ->count(8)
                    ->state(new Sequence(
                        ['override_name' => null],
                        ['override_name' => null],
                        ['override_name' => null],
                        ['override_name' => 'custom list name'],
                    ))            
                )

            ->create();

        $this->command->info('Families created.');

        // Reset the details for Brendan
        $brendan = User::find(7);
        $brendan->name = 'Brendan White';
        $brendan->email = 'brendan@thespia.com';
        $brendan->password = Hash::make('dingodingo');
        $brendan->save();

        $this->command->info('Brendan created.');

    }
}
