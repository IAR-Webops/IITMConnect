<?php

class HomeInfo extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'fathersname', 'mothersname','permaddline1','permaddline2',
		'permcity','permstate','permpincode','permcountry','permphonelandline','permphonemobile',
		'checkboxmailadd','mailaddline1','mailaddline2','mailcity','mailstate','mailpincode',		
		'mailcountry','mailphonelandline','mailphonemobile');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'home_infos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
