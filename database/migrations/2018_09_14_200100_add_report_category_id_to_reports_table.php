<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReportCategoryIdToReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedInteger('report_category_id');
        	
        	$table->foreign('report_category_id')
    			->references('id')->on('report_categories');
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
    		$table->dropForeign(array('report_category_id'));
	        $table->dropColumn(array('report_category_id'));
        });
    }
}
