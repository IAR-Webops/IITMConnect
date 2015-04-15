<?php

class FacebookUser extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'facebook_id', 'facebook_name', 'facebook_firstname','facebook_lastname',
		'facebook_gender','facebook_picture','facebook_email','facebook_accesstoken');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'facebook_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('facebook_accesstoken');

}
