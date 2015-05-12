<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('events', function($table)
            {
                  $table->increments('id');
                  $table->integer('user_id');            
                  $table->integer('event_id');
                  $table->string('event_unique_name');
                  $table->string('event_name');
                  $table->string('event_url');
                  $table->string('event_details_short', 250);
                  $table->string('event_details', 1000);                    
                  $table->string('event_picture');                       
                  $table->string('event_date');
                  $table->string('event_time');
                  $table->string('event_place');
                  $table->string('event_poster');
                  $table->string('event_fb_post_link');                                
                  $table->string('event_fb_event_link');                                
                  $table->string('event_organizer');                                
                  $table->string('event_status');                                
                  $table->string('event_rsvp_status');
                  $table->string('event_has_questions');
                  
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
		Schema::drop('events');		
	}

}
