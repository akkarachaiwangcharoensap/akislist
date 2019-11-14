<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_contact_id');
            $table->text('message');
            $table->timestamps();
        });

        Schema::table('user_messages', function (Blueprint $table) {
        	$table->foreign('user_contact_id')
        		->references('id')->on('user_contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('user_messages', function (Blueprint $table) {
    		$table->dropForeign(array('user_contact_id'));
    		$table->dropColumn(array('user_contact_id'));
    	});

        Schema::dropIfExists('user_messages');
    }
}
