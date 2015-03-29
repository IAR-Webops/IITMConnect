<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacebookUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('facebook_users', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');            
            $table->string('facebook_id')->unique();
            $table->string('facebook_name');
            $table->string('facebook_email');
            $table->string('facebook_accesstoken', 250);                                  
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
		Schema::drop('facebook_users');		
	}

}
