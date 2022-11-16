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
        Schema::table('shopping_lists', function (Blueprint $table) {
            $table->boolean('include_need_soon')
                ->default(true)
                ->after('active');
            $table->boolean('include_usually_need')
                ->default(true)
                ->after('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_lists', function (Blueprint $table) {
            $table->dropColumn('include_need_soon');
            $table->dropColumn('votes');
        });
    }
};
