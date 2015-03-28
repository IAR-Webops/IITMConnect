<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Unauthenticated group */
Route::group(array('before' => 'guest'), function() {

	/* Sign in (GET) */
	Route::get('/account/signin', 
		array('as' => 'account-sign-in',
			'uses' => 'AccountController@getSignIn'
	));

});

/* Authenticated group */
Route::group(array('before' => 'auth'), function() {

	/* Home Page (GET) */
	Route::get('/', 
	  array('as' => 'home', 
	        'uses' => 'PageController@getHome'
	));

});