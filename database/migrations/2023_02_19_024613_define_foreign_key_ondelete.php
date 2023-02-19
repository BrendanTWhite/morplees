<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {

            // join Family   ||--|{ User         : restrictOnDelete
            $table->dropForeign(['family_id']);
            $table->foreign('family_id')
            ->references('id')->on('families')
            ->restrictOnDelete();

        });

        Schema::table('products', function (Blueprint $table) {

            // join Shop     ||--o{ Product      : restrictOnDelete
            $table->dropForeign(['shop_id']);
            $table->foreign('shop_id')
            ->references('id')->on('shops')
            ->restrictOnDelete();

        });

        Schema::table('recipes', function (Blueprint $table) {

            // join Family   ||--o{ Recipe       : restrictOnDelete
            $table->dropForeign(['family_id']);
            $table->foreign('family_id')
            ->references('id')->on('families')
            ->restrictOnDelete();

        });

        Schema::table('ingredients', function (Blueprint $table) {

            // join Recipe   ||--o{ Ingredient   : cascadeOnDelete
            $table->dropForeign(['recipe_id']);
            $table->foreign('recipe_id')
            ->references('id')->on('recipes')
            ->cascadeOnDelete();
    
            // join Product  ||--o{ Ingredient   : restrictOnDelete
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->restrictOnDelete();

        });

        Schema::table('steps', function (Blueprint $table) {

            // join Recipe   ||--o{ Step         : cascadeOnDelete
            $table->dropForeign(['recipe_id']);
            $table->foreign('recipe_id')
            ->references('id')->on('recipes')
            ->cascadeOnDelete();

        });

        Schema::table('shopping_lists', function (Blueprint $table) {

            // join Family   ||--o{ ShoppingList : restrictOnDelete
            $table->dropForeign(['family_id']);
            $table->foreign('family_id')
            ->references('id')->on('families')
            ->restrictOnDelete();

        });

        Schema::table('s_l_recipes', function (Blueprint $table) {

            // join ShoppingList ||--o{ SLRecipe : cascadeOnDelete
            $table->dropForeign(['shopping_list_id']);
            $table->foreign('shopping_list_id')
            ->references('id')->on('shopping_lists')
            ->cascadeOnDelete();

            // join Recipe       ||--o{ SLRecipe : cascadeOnDelete
            $table->dropForeign(['recipe_id']);
            $table->foreign('recipe_id')
            ->references('id')->on('recipes')
            ->cascadeOnDelete();

        });

        Schema::table('s_l_items', function (Blueprint $table) {

            // join ShoppingList ||--o{ SLItem   : cascadeOnDelete
            $table->dropForeign(['shopping_list_id']);
            $table->foreign('shopping_list_id')
            ->references('id')->on('shopping_lists')    
            ->cascadeOnDelete();

            // join SLRecipe     |o--o{ SLItem   : nullOnDelete
            $table->dropForeign(['s_l_recipe_id']);
            $table->unsignedBigInteger('s_l_recipe_id')->nullable()->change();
            $table->foreign('s_l_recipe_id')
            ->references('id')->on('s_l_recipes')
            ->nullOnDelete();

            // join Ingredient   |o--o{ SLItem   : nullOnDelete 
            $table->dropForeign(['ingredient_id']);
            $table->unsignedBigInteger('ingredient_id')->nullable()->change();
            $table->foreign('ingredient_id')
            ->references('id')->on('ingredients')
            ->nullOnDelete();

            // join Product      ||--o{ SLItem   : restrictOnDelete
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->restrictOnDelete();
    
        });

    }

};
