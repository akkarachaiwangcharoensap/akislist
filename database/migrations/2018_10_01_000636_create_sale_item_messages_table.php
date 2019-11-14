<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleItemMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_item_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sale_item_id');
            $table->text('message');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->timestamps();
        });

        Schema::table('sale_item_messages', function (Blueprint $table) {
        	$table->foreign('sale_item_id')
            	->references('id')->on('sale_items');

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
    	Schema::table('sale_item_messages', function (Blueprint $table) {
    		$table->dropForeign(array('sale_item_id'));
    		$table->dropForeign(array('from'));
    		$table->dropForeign(array('to'));

    		$table->dropColumn(array('sale_item_id'));
    		$table->dropColumn(array('from'));
    		$table->dropColumn(array('to'));
    	});

        Schema::dropIfExists('sale_item_messages');
    }
}
