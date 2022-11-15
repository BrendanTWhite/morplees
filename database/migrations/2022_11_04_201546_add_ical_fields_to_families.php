<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // First, add the ical_uuid field.
        // Make it nullable for now because we don't have any data yet.
        // Also add the boolean ical_active field.
        Schema::table('families', function (Blueprint $table) {
            $table->uuid('ical_uuid')->after('name')->nullable();
            $table->boolean('ical_active')->default(false)->after('name');
        });

        // Then, add the initial ical_uuid values (via SQL uuid() for unique values)
        DB::statement('update families set ical_uuid = uuid()');

        // Then, make ical_uuid mandatory (ie not nullable) and unique
        Schema::table('families', function (Blueprint $table) {
            $table->uuid('ical_uuid')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->dropColumn('ical_uuid');
            $table->dropColumn('ical_active');
        });
    }
};
