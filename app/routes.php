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

		/* Sign in with Google Plus (POST) */
		Route::post('/account/signinwithgoogleplus', 
			array('as' => 'account-sign-in-googleplus-post',
				'uses' => 'AccountController@postLoginWithGoogleplus'
		));

		/* Sign in with Linkedin (POST) */
		Route::post('/account/signinwithlinkedin', 
			array('as' => 'account-sign-in-linkedin-post',
				'uses' => 'AccountController@postLoginWithLinkedin'
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

	/* Sign in with Google Plus (GET) */
	Route::get('/account/signinwithgoogleplus', 
		array('as' => 'account-sign-in-googleplus',
			'uses' => 'AccountController@getLoginWithGoogle'
	));

	/* Sign in with Linkedin (GET) */
	Route::get('/account/signinwithlinkedin', 
		array('as' => 'account-sign-in-linkedin',
			'uses' => 'AccountController@getLoginWithLinkedin'
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