<?php

class GoogleplusUser extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'googleplus_id', 'googleplus_name', 'googleplus_firstname', 'googleplus_lastname',
		'googleplus_email','googleplus_link','googleplus_picture','googleplus_gender','googleplus_accesstoken');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'googleplus_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('googleplus_accesstoken');

}
