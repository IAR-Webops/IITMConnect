<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessProgramsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('access_programs', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('unique_name');
            $table->string('short_details');
            $table->string('long_details');
            $table->string('status');
      
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
		Schema::drop('access_programs');		
	}

}
