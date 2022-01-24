<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\{
    Family, User, Shop, Product,
    Recipe, Step, Ingredient,
    ShoppingList, SLRecipe, SLItem,
};
use App\Policies\{
    FamilyPolicy, UserPolicy, ShopPolicy, ProductPolicy,
    RecipePolicy, StepPolicy, IngredientPolicy,
    ShoppingListPolicy, SLRecipePolicy, SLItemPolicy,
};

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
