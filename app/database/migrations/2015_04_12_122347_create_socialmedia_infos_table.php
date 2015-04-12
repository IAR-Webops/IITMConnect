<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialmediaInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('socialmedia_infos', function($table)
            {
                  $table->increments('id');
                  $table->integer('user_id');            
                  $table->string('googleplusprofilelink');
                  $table->string('linkedinprofilelink');
                  $table->string('facebookprofilelink');                  

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
		Schema::drop('socialmedia_infos');				
	}

}
