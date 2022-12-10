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
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['recipe_id']);
            $table->foreign(['recipe_id'])->references('id')->on('recipes')
                ->cascadeOnUpdate()->cascadeOnDelete()->change();
        });

        Schema::table('steps', function (Blueprint $table) {
            $table->dropForeign(['recipe_id']);
            $table->foreign(['recipe_id'])->references('id')->on('recipes')
                ->cascadeOnUpdate()->cascadeOnDelete()->change();
        });
    }
};
