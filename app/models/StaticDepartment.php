<?php

class StaticDepartment extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('deptartment_name', 'deptartment_code');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'static_departments';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
