<?php

class LinkedinUser extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'linkedin_id', 'linkedin_name','linkedin_firstname','linkedin_lastname',
	 'linkedin_email','linkedin_link','linkedin_picture','linkedin_headline','linkedin_accesstoken');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'linkedin_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('linkedin_accesstoken');

}
