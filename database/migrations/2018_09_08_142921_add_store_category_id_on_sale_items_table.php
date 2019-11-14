<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\StoreCategory;

class AddStoreCategoryIdOnSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('sale_items', function (Blueprint $table) {
    		$table->integer('store_category_id')->unsigned()->default(StoreCategory::OTHER);

    		$table->foreign('store_category_id')
    			->references('id')->on('store_categories')
    			->onDelete('cascade');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('sale_items', function (Blueprint $table) {
    		$table->dropForeign(array('store_category_id'));
    		$table->dropColumn('store_category_id');
    	});
   	}
}
