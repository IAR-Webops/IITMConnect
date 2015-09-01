<?php

class StaticMinor extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('minor_name');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'static_minors';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
