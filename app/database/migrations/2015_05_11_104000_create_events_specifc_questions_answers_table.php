<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsSpecifcQuestionsAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('events_specific_questions_answers', function($table)
        {
              $table->increments('id');
              $table->integer('user_id');            
              $table->integer('event_id');
              $table->string('question_id');  
              $table->string('answer_value');                                                                                          
              
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
		Schema::drop('events_specific_questions_answers');								
	}

}
