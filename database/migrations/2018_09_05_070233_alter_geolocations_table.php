<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGeolocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('geolocations', function (Blueprint $table) {
        	$table->renameColumn('geonameid', 'geoname_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('geolocations', function (Blueprint $table) {
        	$table->renameColumn('geoname_id', 'geonameid');
        });
        //
    }
}
