<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGeolocationsFieldsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE geolocations 
        	MODIFY COLUMN dem BIGINT NULL,
        	MODIFY COLUMN elevation INT NULL,
        	MODIFY COLUMN population BIGINT NULL
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE geolocations 
        	MODIFY COLUMN dem BIGINT NOT NULL,
        	MODIFY COLUMN elevation INT NOT NULL,
        	MODIFY COLUMN population BIGINT NOT NULL
        ');
    }
}
