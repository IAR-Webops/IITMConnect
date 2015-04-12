<?php

class InstilifeInfo extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'organization', 'department','post');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'instilife_infos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
