<?php

class SocialmediaInfo extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'googleplusprofilelink', 'linkedinprofilelink','facebookprofilelink');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'socialmedia_infos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
