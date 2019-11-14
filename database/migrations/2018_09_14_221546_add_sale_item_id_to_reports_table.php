<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaleItemIdToReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
        	$table->unsignedInteger('from')->nullable()->change();
        	$table->unsignedInteger('to')->nullable()->change();
        	$table->text('message')->nullable()->change();

            $table->unsignedInteger('sale_item_id')->nullable();

        	$table->foreign('sale_item_id')
    			->references('id')->on('sale_items');        
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
        	$table->unsignedInteger('from')->change();
        	$table->unsignedInteger('to')->change();
        	$table->text('message')->change();

            $table->dropForeign(array('sale_item_id'));
	        $table->dropColumn(array('sale_item_id'));
        });
    }
}
