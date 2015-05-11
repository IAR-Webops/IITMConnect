<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsSpecificQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('events_specific_questions', function($table)
        {
              $table->increments('id');
              $table->integer('user_id');            
              $table->integer('event_id');
              $table->string('question_id');                  
              $table->string('question_value');
              $table->string('question_placeholder');              
              $table->string('question_type');              
              $table->string('question_compulsion');              
              
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
		Schema::drop('events_specific_questions');						
	}

}
