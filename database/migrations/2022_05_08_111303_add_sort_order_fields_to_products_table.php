<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;

class AddSortOrderFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('pantry_sort_order')
                ->default(0)->after('needed_soon');
            $table->unsignedBigInteger('shop_sort_order')
                ->default(0)->after('needed_soon');
        });

        // Default sort order to equal the id.
        // The sort orders will change later.
        Product::where('pantry_sort_order', 0)
            ->update([
                "pantry_sort_order" => DB::raw("`id`"),
            ]);
        Product::where('shop_sort_order', 0)
            ->update([
                "shop_sort_order" => DB::raw("`id`"),
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('pantry_sort_order');
            $table->dropColumn('shop_sort_order');
        });
    }
}
