<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSLItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_l_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained();
            $table->foreignId('shopping_list_id')->constrained();

            // Polymorphic relationship for either Ingredient or Product
            $table->morphs('itemable');

            $table->boolean('already_own');
            $table->boolean('in_basket');            

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
        Schema::dropIfExists('s_l_items');
    }
}
