<?php

class UserEmail extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'user_email', 'user_oauth');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_emails';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
