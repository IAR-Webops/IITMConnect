<?php

class AffinityProgramRegistration extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('userId','status','affinityprogramId');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'affinity_programs_registrations';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
