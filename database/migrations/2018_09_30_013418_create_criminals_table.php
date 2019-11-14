<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criminals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('criminals', function (Blueprint $table) {
            $table->foreign('user_id')
            	->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('criminals', function (Blueprint $table) {
    		$table->dropForeign(array('user_id'));
    		$table->dropColumn(array('user_id'));
    	});

        Schema::dropIfExists('criminals');
    }
}
