<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessProgramsRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('access_programs_registrations', function($table)
        {
            $table->increments('id');
            $table->string('userId');
            $table->string('status');
            $table->string('accessprogramId');
      
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
		Schema::drop('access_programs_registrations');		
	}

}
