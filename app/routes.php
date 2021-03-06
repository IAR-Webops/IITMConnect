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

		/* Basic Info Page (POST) */
		Route::post('/basicinfo/profile-photo',
			array('as' => 'basic-info-profile-photo-post',
				'uses' => 'PageController@postBasicInfoProfilePhoto'
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
		/* Events Management Page (POST) */
		Route::post('/admin/eventmanagement',
			array('as' => 'admin-event-management-post',
				'uses' => 'PageController@postAdminEventManagement'
		));

		/* Admin (Event Management) Events Name Edit (POST) */
		Route::post('admin/eventmanagement/{event_unique_name}/edit',
			array('as'=>'admin-events-name-edit-post', 'uses'=>'PageController@postAdminEventsNameEdit'
		));

		/* Admin (Event Management) Events Name Delete (POST) */
		Route::post('admin/eventmanagement/{event_unique_name}/delete',
			array('as'=>'admin-events-name-delete-post', 'uses'=>'PageController@postAdminEventsNameDelete'
		));

		### AffinityProgram
		/* AffinityProgram Management Page (POST) */
		Route::post('/admin/affinityprogram',
			array('as' => 'affinityprogram-management-post',
				'uses' => 'PageController@postAffinityProgramManagement'
		));

		/* AcessProgram Register (POST) */
		Route::post('affinityprogramregistration',
			array('as'=>'affinityprogram-registration-post', 'uses'=>'PageController@postAffinityProgramRegistration'
		));

		/* Admin (AffinityProgram) Edit (POST) */
		Route::post('admin/affinityprogram/{affinityprogram_unique_name}/edit',
			array('as'=>'admin-affinityprogram-edit-post', 'uses'=>'PageController@postAdminAffinityProgramEdit'
		));

		/* Admin (AffinityProgram) Offer Edit (POST) */
		Route::post('admin/affinityprogram/{affinityprogram_unique_id}/{affinityprogram_offer_id}/edit',
			array('as'=>'admin-affinityprogram-offer-edit-post', 'uses'=>'PageController@postAdminAffinityProgramOfferEdit'
		));

		/* Admin (AffinityProgram) Offer New (POST) */
		Route::post('admin/affinityprogram/{affinityprogram_unique_id}/offer/new',
			array('as'=>'admin-affinityprogram-offer-new-post', 'uses'=>'PageController@postAdminAffinityProgramOfferNew'
		));

		/* Admin (AffinityProgram) Offer Delete (POST) */
		Route::post('admin/affinityprogram/{affinityprogram_unique_id}/{affinityprogram_offer_id}/delete',
			array('as'=>'admin-affinityprogram-offer-delete-post', 'uses'=>'PageController@postAdminAffinityProgramOfferDelete'
		));

		/* Yearbook Edit (POST) */
		Route::post('/yearbook/{rollno}/edit',
			array('as' => 'yearbook-roll-no-edit-post',
				'uses' => 'YearbookController@postYearbookRollNoEdit'
		));

		/* Yearbook Edit - Icons (POST) */
		Route::post('/yearbook/{rollno}/icons/edit',
			array('as' => 'yearbook-roll-no-icons-edit-post',
				'uses' => 'YearbookController@postYearbookRollNoIconsEdit'
		));

		/* Yearbook Edit - Order status (POST) */
		Route::post('/yearbook/{rollno}/order-status/edit',
			array('as' => 'yearbook-roll-no-order-status-edit-post',
				'uses' => 'YearbookController@postYearbookRollNoOrderStatusEdit'
		));

		/* Yearbook Edit - Insti Story (POST) */
		Route::post('/yearbook/{rollno}/edit-insti-story',
			array('as' => 'yearbook-roll-no-edit-insti-story-post',
				'uses' => 'YearbookController@postYearbookRollNoEditInstiStory'
		));

		/* Yearbook Edit - Insti Story (POST) */
		Route::post('/yearbook/{rollno}/edit-group-photo/{group_pic_id}',
			array('as' => 'yearbook-roll-no-edit-group-photo-post',
				'uses' => 'YearbookController@postYearbookRollNoEditGroupPhoto'
		));

		/* Yearbook Edit - Batch Project (POST) */
		Route::post('/yearbook/{rollno}/batch-project/edit',
			array('as' => 'yearbook-roll-no-batch-project-edit-post',
				'uses' => 'YearbookController@postYearbookRollNoBatchProjectEdit'
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

	/* POST without CSRF Protection */
	/* Admin Oauth Management Page (POST) */
	Route::post('/admin/oauthmanagement',
		array('as' => 'admin-oauth-management-post',
			'uses' => 'PageController@postAdminOauthManagement'
	));

	/* Admin Oauth Management Page (POST) */
	Route::post('/oauth/iitmdeveloperapps',
		array('as' => 'iitm-developer-apps-post',
			'uses' => 'PageController@postIITMDeveloperApps'
	));



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

	/* Basic Info Page - Profile Photo (GET) */
	Route::get('/basicinfo/profile-photo',
	  array('as' => 'basic-info-profile-photo',
	        'uses' => 'PageController@getBasicInfoProfilePhoto'
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

	/* Admin (User Management) Registered Users Excel (GET) */
	Route::get('admin/usermanagement/registeredusers/excel',
		array('as'=>'admin-user-management-registered-users-excel', 'uses'=>'PageController@getUserManagementRegisteredUsersExcel'
	));

	/* Admin User Management Page (GET) */
	Route::get('/admin/administrators',
	  array('as' => 'admin-administrators',
	        'uses' => 'PageController@getAdminAdministrators'
	));

	/* Admin Oauth Management Page (GET) */
	Route::get('/admin/oauthmanagement',
	  array('as' => 'admin-oauthmanagement',
	        'uses' => 'PageController@getAdminOauthManagement'
	));

	/* Admin Searchbox JSON Data (GET) */
	Route::get('/searchbox',
	  array('as' => 'search-box',
	        'uses' => 'PageController@postSearchBox'
	));

	/* Admin AffinityProgram Page (GET) */
	Route::get('/admin/affinityprogram',
	  array('as' => 'admin-affinity-program',
	        'uses' => 'PageController@getAdminAffinityProgram'
	));


	### Affinity Program
	/* AffinityProgram Page (GET) */
	Route::get('/affinityprogram',
	  array('as' => 'affinity-program',
	        'uses' => 'PageController@getAffinityProgram'
	));

	/* AffinityProgram Details Page (GET) */
	Route::get('/affinityprogram/{affinityprogram_unique_name}',
	  array('as' => 'affinity-program-details',
	        'uses' => 'PageController@getAffinityProgramDetails'
	));

	/* Admin (AffinityProgram) Registered Users (GET) */
	Route::get('admin/affinityprogram/{affinityprogram_unique_name}/registeredusers',
		array('as'=>'admin-affinityprogram-registered-users', 'uses'=>'PageController@getAdminAffinityProgramRegisteredUsers'
	));

	/* Admin (AffinityProgram) Edit (GET) */
	Route::get('admin/affinityprogram/{affinityprogram_unique_name}/edit',
		array('as'=>'admin-affinityprogram-edit', 'uses'=>'PageController@getAdminAffinityProgramEdit'
	));

	/* Admin (AffinityProgram) Offer Edit (GET) */
	Route::get('admin/affinityprogram/{affinityprogram_unique_id}/{affinityprogram_offer_id}/edit',
		array('as'=>'admin-affinityprogram-offer-edit', 'uses'=>'PageController@getAdminAffinityProgramOfferEdit'
	));

	/* Admin (AffinityProgram) Offer New (GET) */
	Route::get('admin/affinityprogram/{affinityprogram_unique_id}/offer/new',
		array('as'=>'admin-affinityprogram-offer-new', 'uses'=>'PageController@getAdminAffinityProgramOfferNew'
	));

	### END - Admin

	### START - Yearbook

	/* Yearbook (GET) */
	Route::get('/yearbook',
		array('as' => 'yearbook-home',
			'uses' => 'YearbookController@getYearbookHome'
	));


	/* Yearbook Edit (GET) */
	Route::get('/yearbook/{rollno}/edit',
		array('as' => 'yearbook-rollno-edit',
			'uses' => 'YearbookController@getYearbookRollNoEdit'
	));

	/* Yearbook Edit (GET) */
	Route::get('/yearbook/{rollno}/edit-insti-story',
		array('as' => 'yearbook-rollno-edit-insti-story',
			'uses' => 'YearbookController@getYearbookRollNoEditInstiStory'
	));

	/* Yearbook Edit (GET) */
	Route::get('/yearbook/{rollno}/edit-group-photo/{group_pic_id}',
		array('as' => 'yearbook-rollno-edit-group-photo',
			'uses' => 'YearbookController@getYearbookRollNoEditGroupPic'
	));

	### END - Yearbook

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


/* Public Profiles (GET) */
Route::get('/profile/{user_id}',
	array('as' => 'profile-user-id',
		'uses' => 'ProfileController@getProfileUserId'
));

/* Public User Yearbook (GET) */
Route::get('/yearbook/{rollno}',
	array('as' => 'yearbook-roll-no',
		'uses' => 'YearbookController@getYearbookRollNo'
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


/* Oauth2 */

Route::get('/oauth/authorize',
	array('before' => 'check-authorization-params|auth',
    		'uses' => 'Oauth2ServerController@getAuthCodeForm'

));

Route::post('/oauth/authorize',
	array('before' => 'check-authorization-params|auth',
    		'uses' => 'Oauth2ServerController@postAuthCodeForm'
));


Route::post('oauth/access_token',
	array('uses' => 'Oauth2ServerController@postAccessToken'
));
