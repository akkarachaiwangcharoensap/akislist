<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$random = rand(100, 255);
    	$confirmation_token = str_random($random);
        
        DB::table('users')->insert(
        	array(
        		'email' => 'AkkarachaiWangcharoensap@gmail.com',
        		'first_name' => 'Akkarachai',
        		'last_name' => 'Wangcharoensap',
        		'name' => 'Akkarachai Wangcharoensap',
        		'password' => Hash::make('test123'),
        		'confirmation_token' => $confirmation_token
        	)
        );
    }
}
