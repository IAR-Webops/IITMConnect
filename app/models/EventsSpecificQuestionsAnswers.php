<?php

class EventsSpecificQuestionsAnswers extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'event_id', 'question_id','answer_value');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events_specific_questions_answers';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
