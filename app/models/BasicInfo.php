<?php

class BasicInfo extends Eloquent {

	/* Alowing Eloquent to insert data into our database */
	protected $fillable = array('user_id', 'firstname', 'middlename','lastname','department','minor',
		'optionsRadiosDegree','projectguide','email','phone','phonehome','graduatingyear',
		'optionsRadiosFuture','future_field1','future_field2','future_field3','current_city');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'basic_infos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
