<?php

namespace App\Providers;

use App\Models\Family;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Shop;
use App\Models\ShoppingList;
use App\Models\SLItem;
use App\Models\SLRecipe;
use App\Models\Step;
use App\Models\User;
use App\Policies\FamilyPolicy;
use App\Policies\IngredientPolicy;
use App\Policies\ProductPolicy;
use App\Policies\RecipePolicy;
use App\Policies\ShoppingListPolicy;
use App\Policies\ShopPolicy;
use App\Policies\SLItemPolicy;
use App\Policies\SLRecipePolicy;
use App\Policies\StepPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Family::class       => FamilyPolicy::class,
        // User::class         => UserPolicy::class,
        // Shop::class         => ShopPolicy::class,
        // Product::class      => ProductPolicy::class,

        // Recipe::class       => RecipePolicy::class,
        // Step::class         => StepPolicy::class,
        // Ingredient::class   => IngredientPolicy::class,

        // ShoppingList::class => ShoppingListPolicy::class,
        // SLRecipe::class     => SLRecipePolicy::class,
        // SLItem::class       => SLItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
