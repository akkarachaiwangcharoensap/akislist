<?php

use Illuminate\Database\Seeder;

class ReportCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_categories')->insert(array(
        	array(
        		'name' => 'Harassment (harassing you or someone inappropriately)'
        	),
        	array(
        		'name' => 'Scammer (fraud, lie, dishonest, illegitimate)'
        	),
        	array(
        		'name' => 'Abuser (abusing the system to gain benefits or damage the system)'
        	),
        	array(
        		'name' => 'Copyright (copy your post, sell items that is copyright infringement)'
        	),
        	array(
        		'name' => 'Bot (non-human users)'
        	),
        	array(
        		'name' => 'Illegal, terrorist, unlawful, (if you have contacted with this individual or vice versa, for your own safety, please call your local law enforcement to let them know of this individual)'
        	),
        	array(
        		'name' => 'Suspicious individual (if you suspect anyone, you can report to us. We will investigate him/her internally)'
        	),
        	array(
        		'name' => 'Other'
        	)
        ));
    }
}
