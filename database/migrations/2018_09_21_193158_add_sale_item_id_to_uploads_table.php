<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaleItemIdToUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->unsignedInteger('sale_item_id')->after('user_id')->nullable();

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
        Schema::table('uploads', function (Blueprint $table) {
        	$table->dropForeign(array('sale_item_id'));
	        $table->dropColumn(array('sale_item_id'));
        });
    }
}
