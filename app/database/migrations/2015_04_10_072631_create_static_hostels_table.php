<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticHostelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('static_hostels', function($table)
        {
            $table->increments('id');
            $table->string('hostel_name');
            $table->string('hostel_code');
      
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
		// Commenting Drop to prevent Static Data Loss.
		Schema::drop('static_hostels');		
	}

}
