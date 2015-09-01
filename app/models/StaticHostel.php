<?php

class StaticHostel extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('hostel_name', 'hostel_code');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'static_hostels';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
