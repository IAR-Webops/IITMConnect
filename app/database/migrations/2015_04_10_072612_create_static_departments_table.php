<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('static_departments', function($table)
        {
            $table->increments('id');
            $table->string('deptartment_name');
            $table->string('deptartment_code');
      
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
		Schema::drop('static_departments');		
	}

}
