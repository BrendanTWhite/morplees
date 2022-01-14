<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained();

            $table->text('name');
            $table->boolean('default_in_list')->default(false);            
            $table->boolean('needed_soon')->default(false);

            // Additional indexes for convenience and integrity
            $table->foreignId('family_id')->constrained();
            $table->foreign(['family_id', 'shop_id'])
                ->references(['family_id', 'id'])
                ->on('shops');

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
        Schema::dropIfExists('products');
    }
}
