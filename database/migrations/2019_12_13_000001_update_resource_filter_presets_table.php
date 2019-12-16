<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class UpddateResourceFilterPresetsTable
 */
class UpddateResourceFilterPresetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resource_filter_presets', static function (Blueprint $table) {
            $table->rename('resource_presets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resource_presets', static function (Blueprint $table) {
            $table->rename('resource_filter_presets');
        });
    }
}
