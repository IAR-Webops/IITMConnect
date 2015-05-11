<?php

class EventsAttendance extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'event_id', 'event_unique_name','event_survey_status');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events_attendance';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
