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
        Schema::table('s_l_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->foreign(['product_id'])->references('id')->on('products')
                ->cascadeOnUpdate()->cascadeOnDelete()->change();
        });
    }
};
