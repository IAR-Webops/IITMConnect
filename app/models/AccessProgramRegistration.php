<?php

class AccessProgramRegistration extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('userId','status','accessprogramId');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'access_programs_registrations';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
