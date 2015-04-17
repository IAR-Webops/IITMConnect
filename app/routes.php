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

	/* CSRF protection */
	Route::group(array('before' => 'csrf'), function() {

		/* Basic Info Page (POST) */
		Route::post('/basicinfo', 
			array('as' => 'basic-info-post',
				'uses' => 'PageController@postBasicInfo'
		));

		/* Home Info Page (POST) */
		Route::post('/homeinfo', 
			array('as' => 'home-info-post',
				'uses' => 'PageController@postHomeInfo'
		));

		/* Instilife Info Page (POST) */
		Route::post('/instilifeinfo', 
			array('as' => 'instilife-info-post',
				'uses' => 'PageController@postInstilifeInfo'
		));

		
		/* Socialmedia Info Page (POST) */
		Route::post('/socialmediainfo', 
			array('as' => 'socialmedia-info-post',
				'uses' => 'PageController@postSocialmediaInfo'
		));


	});

	/* Sign out (GET) */
	Route::get('/account/signout', 
		array('as' => 'account-sign-out',
			'uses' => 'AccountController@getSignOut'
	));

	/* Home Page (GET) */
	Route::get('/', 
	  array('as' => 'home', 
	        'uses' => 'PageController@getHome'
	));

	/* Basic Info Page (GET) */
	Route::get('/basicinfo', 
	  array('as' => 'basic-info', 
	        'uses' => 'PageController@getBasicInfo'
	));

	/* Home Info Page (GET) */
	Route::get('/homeinfo', 
	  array('as' => 'home-info', 
	        'uses' => 'PageController@getHomeInfo'
	));

	/* Insti Life Info Page (GET) */
	Route::get('/instilifeinfo', 
	  array('as' => 'instilife-info', 
	        'uses' => 'PageController@getInstiLifeInfo'
	));

	/* Instilife Info Page (DELETE) */
	Route::delete('/instilifeinfo', 
		array('as' => 'instilife-info-delete',
			'uses' => 'PageController@deleteInstilifeInfo'
	));


	/* Social Media Info Page (GET) */
	Route::get('/socialmediainfo', 
	  array('as' => 'socialmedia-info', 
	        'uses' => 'PageController@getSocialMediaInfo'
	));

	/* About Us Page (GET) */
	Route::get('/aboutus', 
	  array('as' => 'about-us', 
	        'uses' => 'PageController@getAboutUs'
	));


});