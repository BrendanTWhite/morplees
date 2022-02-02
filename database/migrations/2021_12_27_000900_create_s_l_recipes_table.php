<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSLRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_l_recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained();
            $table->foreignId('shopping_list_id')->constrained();
            $table->foreignId('recipe_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_l_recipes');
    }
}
