<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('sale_item_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('store_items', function (Blueprint $table) {
        	$table->foreign('user_id')
        		->references('id')->on('users')
        		->onDelete('cascade');

        	$table->foreign('sale_item_id')
        		->references('id')->on('sale_items')
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
        Schema::dropIfExists('store_items');
    }
}
