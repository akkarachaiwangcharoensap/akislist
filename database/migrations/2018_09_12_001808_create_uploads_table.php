<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('url');
            $table->string('file_name');
            $table->string('file_type');
            $table->timestamps();
        });

        Schema::table('uploads', function (Blueprint $table) {
    		$table->foreign('user_id')
    			->references('id')->on('users')
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
    	Schema::table('uploads', function (Blueprint $table) {
    		$table->dropForeign(array('user_id'));
    		$table->dropColumn('user_id');
    	});

        Schema::dropIfExists('uploads');
    }
}
