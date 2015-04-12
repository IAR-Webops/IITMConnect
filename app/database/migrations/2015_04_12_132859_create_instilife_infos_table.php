<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstilifeInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('instilife_infos', function($table)
            {
                  $table->increments('id');
                  $table->integer('user_id');            
                  $table->string('organization');
                  $table->string('department');
                  $table->string('post');                  

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
		Schema::drop('instilife_infos');						
	}

}
