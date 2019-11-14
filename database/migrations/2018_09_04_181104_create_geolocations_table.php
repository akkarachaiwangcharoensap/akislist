<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeolocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geolocations', function (Blueprint $table) {
            $table->unsignedInteger('geonameid');
            $table->string('name', 200);
            $table->string('asciiname', 200);
            $table->string('alternatenames', 10000);
            $table->decimal('latitude', 10, 6);
            $table->decimal('longtitude', 10, 6);
            $table->char('feature_class', 1);
            $table->string('feature_code', 10);
            $table->char('country_code', 2);
            $table->string('cc2', 200);
            $table->string('admin1_code', 20);
            $table->string('admin2_code', 80);
            $table->string('admin3_code', 20);
            $table->string('admin4_code', 20);
            $table->bigInteger('population');
            $table->unsignedInteger('elevation');
            $table->bigInteger('dem');
            $table->string('timezone', 40);
            $table->dateTimeTz('modification_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geolocations');
    }
}
