<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameLongtitudeToLongitudeGeoloationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('geolocations', function (Blueprint $table) {
            $table->renameColumn('longtitude', 'longitude');
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
            $table->renameColumn('longitude', 'longtitude');
        });
    }
}
