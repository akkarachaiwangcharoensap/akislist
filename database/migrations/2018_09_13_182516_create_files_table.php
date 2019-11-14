<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('upload_id');
            $table->string('name', 86);
            $table->string('folder', 32);
            $table->timestamps();
        });

        Schema::table('files', function (Blueprint $table) {
        	$table->foreign('user_id')
        		->references('id')->on('users')
        		->onDelete('cascade');

        	$table->foreign('upload_id')
        		->references('id')->on('uploads')
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
        Schema::dropIfExists('files');
    }
}
