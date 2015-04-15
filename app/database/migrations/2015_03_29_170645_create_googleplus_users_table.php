<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleplusUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('googleplus_users', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');            
            $table->string('googleplus_id')->unique();
            $table->string('googleplus_name');
            $table->string('googleplus_firstname');
            $table->string('googleplus_lastname');            
            $table->string('googleplus_email');
            $table->string('googleplus_link');
            $table->string('googleplus_picture');
            $table->string('googleplus_gender');
            $table->string('googleplus_accesstoken', 500);                                  
            $table->string('created_at');
            $table->string('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('googleplus_users');		
	}

}
