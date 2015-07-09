<?php

class EventsModel extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'event_id', 'event_unique_name','event_name',
								'event_url','event_details_short','	event_details','event_picture',
								'event_date','event_time','event_place','event_poster',
								'event_fb_post_link','event_fb_event_link','event_organizer',
								'event_status','event_rsvp_status','event_has_questions');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
