<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIcalFieldsToSLRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, add the uuid field.
        // Make it nullable for now because we don't have any data yet.
        // Also add the date field.
        Schema::table('s_l_recipes', function (Blueprint $table) {
            $table->uuid('uuid')->after('recipe_id')->nullable();
            $table->date('date')->after('recipe_id')->nullable();
        });

        // Then, add the initial uuid values (via SQL uuid() for unique values)
        DB::statement('update s_l_recipes set uuid = uuid()');

        // Then, make uuid mandatory (ie not nullable) and unique
        Schema::table('s_l_recipes', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('s_l_recipes', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('date');
        });
    }
}
