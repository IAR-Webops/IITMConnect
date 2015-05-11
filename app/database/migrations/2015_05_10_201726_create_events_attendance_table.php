<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
			Schema::create('events_attendance', function($table)
            {
                  $table->increments('id');
                  $table->integer('user_id');            
                  $table->integer('event_id');
                  $table->string('event_unique_name');                  
                  $table->string('event_survey_status');
                  
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
		Schema::drop('events_attendance');				
	}

}
