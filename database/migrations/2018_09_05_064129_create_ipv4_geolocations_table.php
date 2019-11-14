<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpv4GeolocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipv4_geolocations', function (Blueprint $table) {
            $table->string('network', 18);
            $table->unsignedInteger('geoname_id');
            $table->unsignedInteger('registered_country_geoname_id');
            $table->unsignedInteger('represented_country_geoname_id');
            $table->boolean('is_annoymous_proxy');
            $table->boolean('is_satellite_provider');
            $table->string('postal_code', 10);
            $table->decimal('latitude', 10, 6);
            $table->decimal('longtitude', 10, 6);
            $table->integer('accuracy_radius');
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
        Schema::dropIfExists('ipv4_geolocations');
    }
}
