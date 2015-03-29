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

	/* CSRF protection */
	Route::group(array('before' => 'csrf'), function() {

		/* Sign in with Facebook (POST) */
		Route::post('/account/signinwithfacebook', 
			array('as' => 'account-sign-in-facebook-post',
				'uses' => 'AccountController@postLoginWithFacebook'
		));

	});

	/* Sign in (GET) */
	Route::get('/account/signin', 
		array('as' => 'account-sign-in',
			'uses' => 'AccountController@getSignIn'
	));

	/* Sign in with Facebook (GET) */
	Route::get('/account/signinwithfacebook', 
		array('as' => 'account-sign-in-facebook',
			'uses' => 'AccountController@getLoginWithFacebook'
	));

});

/* Authenticated group */
Route::group(array('before' => 'auth'), function() {

	/* Home Page (GET) */
	Route::get('/', 
	  array('as' => 'home', 
	        'uses' => 'PageController@getHome'
	));

	/* Sign out (GET) */
	Route::get('/account/signout', 
		array('as' => 'account-sign-out',
			'uses' => 'AccountController@getSignOut'
	));


});