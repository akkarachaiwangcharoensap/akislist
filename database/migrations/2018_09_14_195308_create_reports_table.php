<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->text('message');
            $table->timestamps();
        });

        Schema::table('reports', function (Blueprint $table) {
        	$table->foreign('from')
    			->references('id')->on('users');
    			
    		$table->foreign('to')
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
    	Schema::table('reports', function (Blueprint $table) {
    		$table->dropForeign(array('from'));
    		$table->dropForeign(array('to'));

	        $table->dropColumn(array('from'));
	        $table->dropColumn(array('to'));
    	});
    	
        Schema::dropIfExists('reports');
    }
}
