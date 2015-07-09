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

###
/* Authenticated group */
###
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

		/* Events Questions Answers Page (POST) */
		Route::post('/eventsquestionsanswers', 
			array('as' => 'events-questions-answers-post',
				'uses' => 'PageController@postEventsQuestionsAnwsers'
		));

		### Admin
		/* Events Questions Answers Page (POST) */
		Route::post('/admin/eventmanagement', 
			array('as' => 'admin-event-management-post',
				'uses' => 'PageController@postAdminEventManagement'
		));

		/* Admin (Event Management) Events Name Edit (POST) */
		Route::post('admin/eventmanagement/{event_unique_name}/edit', 
			array('as'=>'admin-events-name-edit-post', 'uses'=>'PageController@postAdminEventsNameEdit'
		));

	});

	/* CSRF protection AJAX */
	Route::group(array('before' => 'csrf-ajax'), function() {

		/* Events Attendance Page (POST) */
		Route::post('/eventsattendance', 
			array('as' => 'events-attendance-post',
				'uses' => 'PageController@postEventsAttendance'
		));

		/* Events Attendance Page (DELETE) */
		Route::delete('/eventsattendance', 
			array('as' => 'events-attendance-delete',
				'uses' => 'PageController@deleteEventsAttendance'
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

	

	/* Oauth Settings Page (GET) */
	Route::get('/oauthsettings', 
	  array('as' => 'oauth-settings', 
	        'uses' => 'PageController@getOauthSettings'
	));

	/* Oauth Settings Page (DELETE) */
	Route::delete('/oauthsettings', 
		array('as' => 'oauth-settings-delete',
			'uses' => 'PageController@deleteOauthSettings'
	));

	/* Add with Facebook (GET) */
	Route::get('/account/addwithfacebook', 
		array('as' => 'account-add-facebook',
			'uses' => 'AccountController@getAddWithFacebook'
	));

	/* Add Google Plus (GET) */
	Route::get('/account/addwithgoogleplus', 
		array('as' => 'account-add-googleplus',
			'uses' => 'AccountController@getAddWithGoogle'
	));

	/* Add Linkedin (GET) */
	Route::get('/account/addwithlinkedin', 
		array('as' => 'account-add-linkedin',
			'uses' => 'AccountController@getAddWithLinkedin'
	));

	/* Events Page (GET) */
	Route::get('/events', 
	  array('as' => 'events', 
	        'uses' => 'PageController@getEvents'
	));

	/* Events Name (GET) */
	Route::get('events/{event_unique_name}', 
		array('as'=>'events-name', 'uses'=>'PageController@getEventsName'
	));

	### Admin
	/* Admin Page (GET) */
	Route::get('/admin', 
	  array('as' => 'admin', 
	        'uses' => 'PageController@getAdmin'
	));

	/* Admin Event Management Page (GET) */
	Route::get('/admin/eventmanagement', 
	  array('as' => 'admin-event-management', 
	        'uses' => 'PageController@getAdminEventManagement'
	));

	/* Admin (Event Management) Events Name Registered Users (GET) */
	Route::get('admin/eventmanagement/{event_unique_name}/registeredusers', 
		array('as'=>'admin-events-name-registered-users', 'uses'=>'PageController@getAdminEventsNameRegisteredUsers'
	));

	/* Admin (Event Management) Registered Users Excel (GET) */
	Route::get('admin/eventmanagement/{event_unique_name}/registeredusers/excel', 
		array('as'=>'admin-events-name-registered-users-excel', 'uses'=>'PageController@getAdminEventsNameRegisteredUsersExcel'
	));
	
	/* Admin (Event Management) Registered Users Responses (GET) */
	Route::get('admin/eventmanagement/{event_unique_name}/registeredusers/responses', 
		array('as'=>'admin-events-name-registered-users-responses', 'uses'=>'PageController@getAdminEventsNameRegisteredUsersResponses'
	));

	/* Admin (Event Management) Events Name Edit (GET) */
	Route::get('admin/eventmanagement/{event_unique_name}/edit', 
		array('as'=>'admin-events-name-edit', 'uses'=>'PageController@getAdminEventsNameEdit'
	));

	/* Admin User Management Page (GET) */
	Route::get('/admin/usermanagement', 
	  array('as' => 'admin-user-management', 
	        'uses' => 'PageController@getAdminUserManagement'
	));

	/* Admin User Management Page (GET) */
	Route::get('/searchbox', 
	  array('as' => 'search-box', 
	        'uses' => 'PageController@postSearchBox'
	));

});

###
/*
	No Group - Accessible by All
*/

/* About Us Page (GET) */
Route::get('/aboutus', 
  array('as' => 'about-us', 
        'uses' => 'PageController@getAboutUs'
));

/* Privacy Policy Page (GET) */
Route::get('/privacypolicy', 
  array('as' => 'privacy-policy', 
        'uses' => 'PageController@getPrivacyPolicy'
));

/* Report Issues Page (GET) */
Route::get('/reportissues', 
  array('as' => 'report-issues', 
        'uses' => 'PageController@getReportIssues'
));


/* Debuggin Page (GET) */

// Created to see Error Outputs for Oauth Sign in Pages.
// Tackles Redirect issue.
Route::get('/debug', 
  array('as' => 'debug', 
        'uses' => 'AccountController@getDebug'
));

// Test Page
Route::get('/debug/test', 
  array('as' => 'debug-test', 
        'uses' => 'AccountController@getDebugTest'
));
// Test Page
Route::post('/debug/test', 
  array('as' => 'debug-test-post', 
        'uses' => 'AccountController@getDebugTestPost'
));