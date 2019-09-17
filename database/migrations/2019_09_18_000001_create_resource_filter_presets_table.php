<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateResourceFilterPresetsTable
 */
class CreateResourceFilterPresetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_filter_presets', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('resource')->index();
            $table->json('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_filter_presets');
    }
}
