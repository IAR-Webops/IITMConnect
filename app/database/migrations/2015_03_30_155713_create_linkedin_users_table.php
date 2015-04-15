<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedinUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('linkedin_users', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');            
            $table->string('linkedin_id')->unique();
            $table->string('linkedin_name');
            $table->string('linkedin_firstname');
            $table->string('linkedin_lastname');            
            $table->string('linkedin_email');
            $table->string('linkedin_link');
            $table->string('linkedin_picture');
            $table->string('linkedin_headline');
            $table->string('linkedin_accesstoken', 500);                                  
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
		Schema::drop('linkedin_users');				
	}

}
