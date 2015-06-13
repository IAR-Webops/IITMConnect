<?php

class AccountController extends BaseController {


	### Sign Out
	public function getSignOut() {
		Auth::logout();
		
		return Redirect::route('home');
	}

	
	### Sign In
	/* Viewing the form */
	public function getSignIn() {
		return View::make('account.signin');
	}

	/* Login user with facebook */
	public function getLoginWithFacebook() {

	    // get data from input
	    $code = Input::get( 'code' );

	    // get fb service
	    $fb = OAuth::consumer( 'Facebook' );

	    // check if code is valid

	    // if code is provided get user data and sign in
	    if ( !empty( $code ) ) {

	        // This was a callback request from facebook, get the token
	        $token = $fb->requestAccessToken( $code );
	        //dd($token->getAccessToken());
	        $accesstoken = $token->getAccessToken();

	        // Send a request with it
	        $result = json_decode( $fb->request( 
	        	'/me?fields=id,name,first_name,last_name,picture,gender,email,link' 
	        	), true );	

	        //Initialize Empty Result Array to avoid missing Oauth return parameters	
			// Not Including "ID","Email","Access Token"
	        if (!array_key_exists('name', $result)) {	$result['name'] = "";	}
	        if (!array_key_exists('first_name', $result)) {	$result['first_name'] = "";	}
	        if (!array_key_exists('last_name', $result)) {	$result['last_name'] = "";	}
	        if (!array_key_exists('gender', $result)) {	$result['gender'] = "";	}			        
	        if (!array_key_exists('email', $result)) {	$result['email'] = "";	}
			if (!array_key_exists('picture', $result)) { $result['picture'] = "";	}

			$result['accesstoken'] = $accesstoken;	

			//$result['facebook_picture'] = "Test";      
	        //Var_dump
	        //display whole array().
	        //dd($result["picture"]["data"]["url"]);

	        View::share('result',$result);

	        // Fetch The Roll Number from Imported Data based on Email ID
			$emailid = $result['email'];
			$fetchrollnumber = $this->getRollnumberWilkommen($emailid);
			View::share('fetchrollnumber',$fetchrollnumber);


	        $useremail = UserEmail::where('user_email', '=', $result['email']);
	        // Check if User already registered with this Email ID. To fetch his Roll No. automatically.
			if($useremail->count()) {
						
				$useremail = $useremail->first();
				$user_id = $useremail->user_id;

				// Assumption: If an email exists in UserEmail there has to be corresponding Owner for it in User.
	        	$user = User::find($user_id);
	        	if($user){		        		
		        	// Manually Login the User
		        	Auth::login($user);
	        	} else {
	        		return View::make('account.signinwithfacebook');
	        	}

	        	// Saving Facebook Data if doesn't exist already
	        	$facebookuser = FacebookUser::where('facebook_email', '=', $result['email']);
	        	if($facebookuser->count()) {
	        		// Do nothing
	        	} else {
	        		$facebookuserdata = FacebookUser::create(array(
	        			'user_id'				=> $user_id,
						'facebook_id' 			=> $result['id'],
						'facebook_name'			=> $result['name'],
						'facebook_firstname'	=> $result['first_name'],
						'facebook_lastname'		=> $result['last_name'],
						'facebook_gender'		=> $result['gender'],						
						'facebook_email'		=> $result['email'],
						'facebook_picture'		=> $result['picture']['data']['url'],						
						'facebook_accesstoken'	=> $result['accesstoken']
					));
	        	}

				return $this->getAutofillFetched('facebook');
	        	
	        	//return Redirect::route('home');

			} else {

	        	return View::make('account.signinwithfacebook');
				
			}


	    }
	    // if not ask for permission first
	    else {
	        // get fb authorization
	        $url = $fb->getAuthorizationUri();

	        // return to facebook login url
	         return Redirect::to( (string)$url );
	    }

	}

	public function postLoginWithFacebook() {

		$validator = Validator::make(Input::all(),
			array(
				'facebook_id' 			=> 'required',
				'facebook_name'			=> 'required',
				'facebook_firstname'	=> 'required',
				'facebook_lastname'		=> 'required',
				'facebook_gender'		=> 'required',
				'facebook_email'		=> 'required',
				'facebook_picture'		=> 'required',				
				'facebook_accesstoken'	=> 'required',
				'rollno'				=> 'required|min:7'
			)
		);

		if($validator->fails()) {
			return Redirect::route('debug')
				->withErrors($validator)
	            ->with('errororigin', 'Error Originated from Facebook Oauth')				
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// create an account
			$facebook_id 			= Input::get('facebook_id');
			$facebook_name 			= Input::get('facebook_name');
			$facebook_firstname 	= Input::get('facebook_firstname');
			$facebook_lastname 		= Input::get('facebook_lastname');
			$facebook_gender 		= Input::get('facebook_gender');
			$facebook_email 		= Input::get('facebook_email');
			$facebook_picture 		= Input::get('facebook_picture');
			$facebook_accesstoken 	= Input::get('facebook_accesstoken');
			$rollno 				= Input::get('rollno');

			// Check if this Roll No. exists in User
			// Fetch that User ID and save facebook data along with that.
			$user = User::where('rollno', '=', $rollno);

			if($user->count()) {
						
				$user = $user->first();
				$user_id = $user->id;
				//return "Existing ".$user_id;

			} else { // Create new User with this Roll No.

				$userdata = User::create(array(
					'rollno' 	=> $rollno,			
					'active'	=> 0
				));

				// Fetch the User id of the User just saved
				$usersaved = User::where('rollno', '=', $rollno);
					if($user->count()) {							
						$user = $user->first();
						$user_id = $user->id;
						//return "New User ".$user_id;
					} 

			}

			// Save Facebook Data in facebook_users using the $user_id
			$userdata = FacebookUser::create(array(
				'user_id'				=> $user_id,				
				'facebook_id' 			=> $facebook_id,			
				'facebook_name'			=> $facebook_name,
				'facebook_firstname'	=> $facebook_firstname,
				'facebook_lastname'		=> $facebook_lastname,
				'facebook_gender'		=> $facebook_gender,
				'facebook_email'		=> $facebook_email,			
				'facebook_picture'		=> $facebook_picture,
				'facebook_accesstoken'	=> $facebook_accesstoken
			));

			// Save User's Email in user_email using the $user_id
			$useremaildata = UserEmail::create(array(
				'user_id'				=> $user_id,				
				'user_email' 			=> $facebook_email,			
				'user_oauth'			=> 'facebook'
			));

			$user = User::find($user_id);
        	if($user){		        		
	        	// Manually Login the User
	        	Auth::login($user);
        	} else {
        		return View::make('account.signinwithfacebook');
        	}

		}

		//dd(Input::all());

		return $this->getAutofillFetched('facebook');

		//return Redirect::route('home');

	}


	/* Add user with facebook */
	// This funtion will be called by only Logged in Users
	public function getAddWithFacebook() {

	    // get data from input
	    $code = Input::get( 'code' );

	    // get fb service
	    $fb = OAuth::consumer( 'Facebook' );

	    // check if code is valid

	    // if code is provided get user data and sign in
	    if ( !empty( $code ) ) {

	        // This was a callback request from facebook, get the token
	        $token = $fb->requestAccessToken( $code );
	        //dd($token->getAccessToken());
	        $accesstoken = $token->getAccessToken();

	        // Send a request with it
	        $result = json_decode( $fb->request( '/me' ), true );	

	        //Initialize Empty Result Array to avoid missing Oauth return parameters	
			// Not Including "ID","Email","Access Token"
	        if (!array_key_exists('name', $result)) {	$result['name'] = "";	}
	        if (!array_key_exists('first_name', $result)) {	$result['first_name'] = "";	}
	        if (!array_key_exists('last_name', $result)) {	$result['last_name'] = "";	}
	        if (!array_key_exists('gender', $result)) {	$result['gender'] = "";	}			        
	        if (!array_key_exists('email', $result)) {	$result['email'] = "";	}
			if (!array_key_exists('email', $result)) { $result['email'] = "";	}

			$result['accesstoken'] = $accesstoken;	      
	        //Var_dump
	        //display whole array().
	        //dd($result);

			$user_id = Auth::id();
		        
        	// Saving Facebook Data if doesn't exist already
        	$facebookuser = FacebookUser::where('facebook_email', '=', $result['email']);
        	if($facebookuser->count()) {
        		return "Cannot Add. User with this email address already exists.";
        	} else {
        		$facebookuserdata = FacebookUser::create(array(
        			'user_id'				=> $user_id,
					'facebook_id' 			=> $result['id'],
					'facebook_name'			=> $result['name'],
					'facebook_firstname'	=> $result['first_name'],
					'facebook_lastname'		=> $result['last_name'],
					'facebook_gender'		=> $result['gender'],						
					'facebook_email'		=> $result['email'],
					'facebook_picture'		=> $result['email'],						
					'facebook_accesstoken'	=> $result['accesstoken']
				));
				return Redirect::route('oauth-settings')
                    ->with('globalalertmessage', 'Facebook Oauth Added')
                    ->with('globalalertclass', 'success');
        	}



	    }
	    // if not ask for permission first
	    else {
	        // get fb authorization
	        $url = $fb->getAuthorizationUri();

	        // return to facebook login url
	         return Redirect::to( (string)$url );
	    }

	}

	/* Sign in with Google Plus */
	public function getLoginWithGoogle() {

	    // get data from input
	    $code = Input::get( 'code' );

	    // get google service
	    $googleService = OAuth::consumer( 'Google' );

	    // check if code is valid

	    // if code is provided get user data and sign in
	    if ( !empty( $code ) ) {

	        // This was a callback request from google, get the token
	        $token = $googleService->requestAccessToken( $code );
		    //dd($token->getAccessToken());
			$accesstoken = $token->getAccessToken();

	        // Send a request with it
	        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

			//Initialize Empty Result Array to avoid missing Oauth return parameters	
			// Not Including "ID","Email","Access Token"
	        if (!array_key_exists('name', $result)) {	$result['name'] = "";	}
	        if (!array_key_exists('given_name', $result)) {	$result['given_name'] = "";	}
	        if (!array_key_exists('family_name', $result)) {	$result['family_name'] = "";	}
	        if (!array_key_exists('link', $result)) {	$result['link'] = "";	}			        
	        if (!array_key_exists('picture', $result)) {	$result['picture'] = "";	}
			if (!array_key_exists('gender', $result)) { $result['gender'] = "";	}

			$result['accesstoken'] = $accesstoken;	      

	        //Var_dump
	        //display whole array().
	        //dd($result);

			View::share('result',$result);

			// Fetch The Roll Number from Imported Data based on Email ID
			$emailid = $result['email'];
			$fetchrollnumber = $this->getRollnumberWilkommen($emailid);
			View::share('fetchrollnumber',$fetchrollnumber);


			$useremail = UserEmail::where('user_email', '=', $result['email']);
	        // Check if User already registered with this Email ID. To fetch his Roll No. automatically.
			if($useremail->count()) {
						
				$useremail = $useremail->first();
				$user_id = $useremail->user_id;

				// Assumption: If an email exists in UserEmail there has to be corresponding Owner for it in User.
	        	$user = User::find($user_id);
	        	if($user){		        		
		        	// Manually Login the User
		        	Auth::login($user);
	        	} else {
	        		return View::make('account.signinwithgoogleplus');
	        	}

	        	// Saving Googleplus Data if doesn't exist already
	        	$googleplususer = GoogleplusUser::where('googleplus_email', '=', $result['email']);
	        	if($googleplususer->count()) {
	        		// Do nothing
	        	} else {
	        		$googleplususerdata = GoogleplusUser::create(array(
	        			'user_id'					=> $user_id,
						'googleplus_id' 			=> $result['id'],
						'googleplus_name'			=> $result['name'],
						'googleplus_firstname'		=> $result['given_name'],
						'googleplus_lastname'		=> $result['family_name'],						
						'googleplus_email'			=> $result['email'],
						'googleplus_link'			=> $result['link'],
						'googleplus_picture'		=> $result['picture'],
						'googleplus_gender'			=> $result['gender'],
						'googleplus_accesstoken'	=> $result['accesstoken']						
					));
	        	}

				return $this->getAutofillFetched('googleplus');

	        	//return Redirect::route('home');

			} else {

	        	return View::make('account.signinwithgoogleplus');
				
			}


	    }
	    // if not ask for permission first
	    else {
	        // get googleService authorization
	        $url = $googleService->getAuthorizationUri();

	        // return to google login url
	        return Redirect::to( (string)$url );
	    }
	}

	public function postLoginWithGoogleplus() {
		

		$validator = Validator::make(Input::all(),
			array(
				'googleplus_id' 			=> 'required',
				'googleplus_name'			=> 'required',
				'googleplus_firstname'		=> 'required',
				'googleplus_lastname'		=> 'required',				
				'googleplus_email'			=> 'required',
				'googleplus_link'			=> 'required',
				'googleplus_picture'		=> 'required',
				'googleplus_gender'			=> 'required',
				'googleplus_accesstoken'	=> 'required',				
				'rollno'					=> 'required|min:7'
			)
		);

		if($validator->fails()) {
//			return Redirect::route('account-sign-in-googleplus')
			return Redirect::route('debug')
				->withErrors($validator)
	            ->with('errororigin', 'Error Originated from Google Plus Oauth')								
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// create an account
			$googleplus_id 			= Input::get('googleplus_id');
			$googleplus_name 		= Input::get('googleplus_name');
			$googleplus_firstname 	= Input::get('googleplus_firstname');
			$googleplus_lastname 	= Input::get('googleplus_lastname');			
			$googleplus_email 		= Input::get('googleplus_email');
			$googleplus_link 		= Input::get('googleplus_link');
			$googleplus_picture 	= Input::get('googleplus_picture');
			$googleplus_gender 		= Input::get('googleplus_gender');
			$googleplus_accesstoken = Input::get('googleplus_accesstoken');			
			$rollno 				= Input::get('rollno');

			// Check if this Roll No. exists in User
			// Fetch that User ID and save googleplus data along with that.
			$user = User::where('rollno', '=', $rollno);

			if($user->count()) {
						
				$user = $user->first();
				$user_id = $user->id;
				//return "Existing ".$user_id;

			} else { // Create new User with this Roll No.

				$userdata = User::create(array(
					'rollno' 	=> $rollno,			
					'active'	=> 0
				));

				// Fetch the User id of the User just saved
				$usersaved = User::where('rollno', '=', $rollno);
					if($user->count()) {							
						$user = $user->first();
						$user_id = $user->id;
						//return "New User ".$user_id;
					} 

			}

			// Save Googleplus Data in googleplus_users using the $user_id
			$userdata = GoogleplusUser::create(array(
				'user_id'					=> $user_id,				
				'googleplus_id' 			=> $googleplus_id,			
				'googleplus_name'			=> $googleplus_name,
				'googleplus_firstname'		=> $googleplus_firstname,
				'googleplus_lastname'		=> $googleplus_lastname,
				'googleplus_email'			=> $googleplus_email,				
				'googleplus_link'			=> $googleplus_link,
				'googleplus_picture'		=> $googleplus_picture,
				'googleplus_gender'			=> $googleplus_gender,
				'googleplus_accesstoken'	=> $googleplus_accesstoken
			));

			// Save User's Email in user_email using the $user_id
			$useremaildata = UserEmail::create(array(
				'user_id'				=> $user_id,				
				'user_email' 			=> $googleplus_email,			
				'user_oauth'			=> 'googleplus'
			));

			$user = User::find($user_id);
        	if($user){		        		
	        	// Manually Login the User
	        	Auth::login($user);
        	} else {
        		return View::make('account.signinwithgoogleplus');
        	}

		}

		//dd(Input::all());

		return $this->getAutofillFetched('googleplus');
		
		//return Redirect::route('home');

	}

	/* Add with Google Plus */
	// This funtion will be called by only Logged in Users	
	public function getAddWithGoogle() {

	    // get data from input
	    $code = Input::get( 'code' );

	    // get google service
	    $googleService = OAuth::consumer( 'Google' );

	    // check if code is valid

	    // if code is provided get user data and sign in
	    if ( !empty( $code ) ) {

	        // This was a callback request from google, get the token
	        $token = $googleService->requestAccessToken( $code );
		    //dd($token->getAccessToken());
			$accesstoken = $token->getAccessToken();

	        // Send a request with it
	        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

			//Initialize Empty Result Array to avoid missing Oauth return parameters	
			// Not Including "ID","Email","Access Token"
	        if (!array_key_exists('name', $result)) {	$result['name'] = "";	}
	        if (!array_key_exists('given_name', $result)) {	$result['given_name'] = "";	}
	        if (!array_key_exists('family_name', $result)) {	$result['family_name'] = "";	}
	        if (!array_key_exists('link', $result)) {	$result['link'] = "";	}			        
	        if (!array_key_exists('picture', $result)) {	$result['picture'] = "";	}
			if (!array_key_exists('gender', $result)) { $result['gender'] = "";	}

			$result['accesstoken'] = $accesstoken;	      

	        //Var_dump
	        //display whole array().
	        //dd($result);

			$user_id = Auth::id();
	        
        	// Saving Googleplus Data if doesn't exist already
        	$googleplususer = GoogleplusUser::where('googleplus_email', '=', $result['email']);
        	if($googleplususer->count()) {
        		return "Cannot Add Googleplus Oauth. User with this email address already exists.";
        	} else {
        		$googleplususerdata = GoogleplusUser::create(array(
        			'user_id'					=> $user_id,
					'googleplus_id' 			=> $result['id'],
					'googleplus_name'			=> $result['name'],
					'googleplus_firstname'		=> $result['given_name'],
					'googleplus_lastname'		=> $result['family_name'],						
					'googleplus_email'			=> $result['email'],
					'googleplus_link'			=> $result['link'],
					'googleplus_picture'		=> $result['picture'],
					'googleplus_gender'			=> $result['gender'],
					'googleplus_accesstoken'	=> $result['accesstoken']						
				));
				return Redirect::route('oauth-settings')
                	->with('globalalertmessage', 'Google Plus Oauth Added')
                	->with('globalalertclass', 'success');
        	}

	    }
	    // if not ask for permission first
	    else {
	        // get googleService authorization
	        $url = $googleService->getAuthorizationUri();

	        // return to google login url
	        return Redirect::to( (string)$url );
	    }
	}


	/* Sign in with Linkedin */
	public function getLoginWithLinkedin() {

		// get data from input
		$code = Input::get( 'code' );

		$linkedinService = OAuth::consumer( 'Linkedin' );


		if ( !empty( $code ) ) {

		    // This was a callback request from linkedin, get the token
		    $token = $linkedinService->requestAccessToken( $code );
		    //dd($token->getAccessToken());
			$accesstoken = $token->getAccessToken();

		    // Send a request with it. Please note that XML is the default format.
		    $result = json_decode($linkedinService->request('/people/~:(id,num-connections,picture-url,first-name,last-name,email-address,headline,siteStandardProfileRequest)?format=json'), true);
			
		    //Initialize Empty Result Array to avoid missing Oauth return parameters	
			// Not Including "ID","Email","Access Token"
	        if (!array_key_exists('name', $result)) {	$result['name'] = "";	}
	        if (!array_key_exists('firstName', $result)) {	$result['firstName'] = "";	}
	        if (!array_key_exists('lastName', $result)) {	$result['lastName'] = "";	}
	        if (!array_key_exists('siteStandardProfileRequest', $result)) {	$result['siteStandardProfileRequest'] = "";	}			        
	        if (!array_key_exists('pictureUrl', $result)) {	$result['pictureUrl'] = "";	}
			if (!array_key_exists('headline', $result)) { $result['headline'] = "";	}

			$result['name'] = $result['firstName'] . " " . $result['lastName'];
			$result['accesstoken'] = $accesstoken;	      

		    //Var_dump
		    //display whole array().
		    //return $result['siteStandardProfileRequest']['url'];
		    //dd($result);

			View::share('result',$result);

			// Fetch The Roll Number from Imported Data based on Email ID
			$emailid = $result['emailAddress'];
			$fetchrollnumber = $this->getRollnumberWilkommen($emailid);
			View::share('fetchrollnumber',$fetchrollnumber);


			//return "Received - ".$fetchrollnumber;


	        $useremail = UserEmail::where('user_email', '=', $result['emailAddress']);
	        // Check if User already registered with this Email ID. To fetch his Roll No. automatically.
			if($useremail->count()) {
						
				$useremail = $useremail->first();
				$user_id = $useremail->user_id;

				// Assumption: If an email exists in UserEmail there has to be corresponding Owner for it in User.
	        	$user = User::find($user_id);
	        	if($user){		        		
		        	// Manually Login the User
		        	Auth::login($user);
	        	} else {
	        		return View::make('account.signinwithlinkedin');
	        	}

	        	// Saving Linkedin Data if doesn't exist already
	        	$linkedinuser = LinkedinUser::where('linkedin_email', '=', $result['emailAddress']);
	        	if($linkedinuser->count()) {
	        		// Do nothing
	        	} else {
	        		$linkedinuserdata = LinkedinUser::create(array(
	        			'user_id'				=> $user_id,
						'linkedin_id' 			=> $result['id'],
						'linkedin_name'			=> $result['name'],
						'linkedin_firstname'	=> $result['firstName'],
						'linkedin_lastname'		=> $result['lastName'],
						'linkedin_email'		=> $result['emailAddress'],
						'linkedin_link'			=> $result['siteStandardProfileRequest']['url'],
						'linkedin_picture'		=> $result['pictureUrl'],
						'linkedin_headline'		=> $result['headline'],
						'linkedin_accesstoken'	=> $result['accesstoken']						
					));
	        	}

				return $this->getAutofillFetched('linkedin');


	        	//return Redirect::route('autofill-fetched')
				//		->with('oauth_client','linkedin');					

			} else {

	        	return View::make('account.signinwithlinkedin');
				
			}



		}// if not ask for permission first
		else {
		    // get linkedinService authorization
		    $url = $linkedinService->getAuthorizationUri(array('state'=>'DCEEFWF45453sdffef424'));

		    // return to linkedin login url
		    return Redirect::to( (string)$url );
		}

	}

	public function postLoginWithLinkedin() {

		$validator = Validator::make(Input::all(),
			array(
				'linkedin_id' 			=> 'required',
				'linkedin_name'			=> 'required',
				'linkedin_firstname'	=> 'required',
				'linkedin_lastname'		=> 'required',
				'linkedin_email'		=> 'required',
				'linkedin_link'			=> 'required',
				'linkedin_picture'		=> 'required',
				'linkedin_headline'		=> 'required',
				'linkedin_accesstoken'	=> 'required',				
				'rollno'				=> 'required|min:7'
			)
		);

		if($validator->fails()) {
			return Redirect::route('debug')
				->withErrors($validator)
	            ->with('errororigin', 'Error Originated from Linkedin Oauth')								
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// create an account
			$linkedin_id 			= Input::get('linkedin_id');
			$linkedin_name 			= Input::get('linkedin_name');
			$linkedin_firstname 	= Input::get('linkedin_firstname');
			$linkedin_lastname 		= Input::get('linkedin_lastname');
			$linkedin_email 		= Input::get('linkedin_email');
			$linkedin_link 			= Input::get('linkedin_link');
			$linkedin_picture 		= Input::get('linkedin_picture');
			$linkedin_headline 		= Input::get('linkedin_headline');
			$linkedin_accesstoken 	= Input::get('linkedin_accesstoken');			
			$rollno 				= Input::get('rollno');

			// Check if this Roll No. exists in User
			// Fetch that User ID and save linkedin data along with that.
			$user = User::where('rollno', '=', $rollno);

			if($user->count()) {
						
				$user = $user->first();
				$user_id = $user->id;
				//return "Existing ".$user_id;

			} else { // Create new User with this Roll No.

				$userdata = User::create(array(
					'rollno' 	=> $rollno,			
					'active'	=> 0
				));

				// Fetch the User id of the User just saved
				$usersaved = User::where('rollno', '=', $rollno);
					if($user->count()) {							
						$user = $user->first();
						$user_id = $user->id;
						//return "New User ".$user_id;
					} 

			}

			// Save Linkedin Data in linkedin_users using the $user_id
			$userdata = LinkedinUser::create(array(
				'user_id'				=> $user_id,				
				'linkedin_id' 			=> $linkedin_id,			
				'linkedin_name'			=> $linkedin_name,
				'linkedin_firstname'	=> $linkedin_firstname,
				'linkedin_lastname'		=> $linkedin_lastname,
				'linkedin_email'		=> $linkedin_email,				
				'linkedin_link'			=> $linkedin_link,
				'linkedin_picture'		=> $linkedin_picture,
				'linkedin_headline'		=> $linkedin_headline,
				'linkedin_accesstoken'	=> $linkedin_accesstoken
			));

			// Save User's Email in user_email using the $user_id
			$useremaildata = UserEmail::create(array(
				'user_id'				=> $user_id,				
				'user_email' 			=> $linkedin_email,			
				'user_oauth'			=> 'linkedin'
			));

			$user = User::find($user_id);
        	if($user){		        		
	        	// Manually Login the User
	        	Auth::login($user);
        	} else {
        		return View::make('account.signinwithlinkedin');
        	}

		}

		//dd(Input::all());

		return $this->getAutofillFetched('linkedin');

		//return Redirect::route('autofill-fetched')
		//			->with('oauth_client','linkedin');

	}

	/* Add with Linkedin */
	// This funtion will be called by only Logged in Users	
	public function getAddWithLinkedin() {

		// get data from input
		$code = Input::get( 'code' );

		$linkedinService = OAuth::consumer( 'Linkedin' );


		if ( !empty( $code ) ) {

		    // This was a callback request from linkedin, get the token
		    $token = $linkedinService->requestAccessToken( $code );
		    //dd($token->getAccessToken());
			$accesstoken = $token->getAccessToken();

		    // Send a request with it. Please note that XML is the default format.
		    $result = json_decode($linkedinService->request('/people/~:(id,num-connections,picture-url,first-name,last-name,email-address,headline,siteStandardProfileRequest)?format=json'), true);
			
		    //Initialize Empty Result Array to avoid missing Oauth return parameters	
			// Not Including "ID","Email","Access Token"
	        if (!array_key_exists('name', $result)) {	$result['name'] = "";	}
	        if (!array_key_exists('firstName', $result)) {	$result['firstName'] = "";	}
	        if (!array_key_exists('lastName', $result)) {	$result['lastName'] = "";	}
	        if (!array_key_exists('siteStandardProfileRequest', $result)) {	$result['siteStandardProfileRequest'] = "";	}			        
	        if (!array_key_exists('pictureUrl', $result)) {	$result['pictureUrl'] = "";	}
			if (!array_key_exists('headline', $result)) { $result['headline'] = "";	}

			$result['name'] = $result['firstName'] . " " . $result['lastName'];
			$result['accesstoken'] = $accesstoken;	      

		    //Var_dump
		    //display whole array().
		    //return $result['siteStandardProfileRequest']['url'];
		    //dd($result);

			$user_id = Auth::id();
				    
        	// Saving Linkedin Data if doesn't exist already
        	$linkedinuser = LinkedinUser::where('linkedin_email', '=', $result['emailAddress']);
        	if($linkedinuser->count()) {
        		return "Cannot Add Linkedin Oauth. User with this email address already exists.";
        	} else {
        		$linkedinuserdata = LinkedinUser::create(array(
        			'user_id'				=> $user_id,
					'linkedin_id' 			=> $result['id'],
					'linkedin_name'			=> $result['name'],
					'linkedin_firstname'	=> $result['firstName'],
					'linkedin_lastname'		=> $result['lastName'],
					'linkedin_email'		=> $result['emailAddress'],
					'linkedin_link'			=> $result['siteStandardProfileRequest']['url'],
					'linkedin_picture'		=> $result['pictureUrl'],
					'linkedin_headline'		=> $result['headline'],
					'linkedin_accesstoken'	=> $result['accesstoken']						
				));
				return Redirect::route('oauth-settings')
                	->with('globalalertmessage', 'Linkedin Oauth Added')
	            	->with('globalalertclass', 'success');
        	}				

		}// if not ask for permission first
		else {
		    // get linkedinService authorization
		    $url = $linkedinService->getAuthorizationUri(array('state'=>'DCEEFWF45453sdffef424'));

		    // return to linkedin login url
		    return Redirect::to( (string)$url );
		}

	}


	/* Autofill Fetched Data from Social Logins */
	public function getAutofillFetched($oauth_client) {

		// This Function will be called upon every Successfull Login
		/*
		* The purpose of this Function is to Autofill the Basic Info form fields with data that is 
		* fetched using Social Login.
		*/
		$user_id = Auth::id();

		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	// Skip Autofill since info Basic Info already exists


			// Redirecting to Basic Info instead of Home Page.
			//return Redirect::route('basic-info');
			// Redirect the user to the URL they were trying to access before being 
			// caught by the authentication filter.
			return Redirect::intended('basic-info');

			//return Redirect::route('home');	

		} else { // Else auto fill since Basic Info is empty

			switch ($oauth_client) {
				case 'facebook':
					$facebookuser = DB::table('facebook_users')->where('user_id', $user_id)->first();

					$firstname 	= $facebookuser->facebook_firstname;
					$lastname 	= $facebookuser->facebook_lastname;
					$email 		= $facebookuser->facebook_email;
					
					//return var_dump($facebookuser);
					break;
				case 'googleplus':
					$googleplususer = DB::table('googleplus_users')->where('user_id', $user_id)->first();
					
					$firstname 	= $googleplususer->googleplus_firstname;
					$lastname 	= $googleplususer->googleplus_lastname;
					$email 		= $googleplususer->googleplus_email;
					
					//return var_dump($googleplususer);					
					break;
				case 'linkedin':
					$linkedinuser = DB::table('linkedin_users')->where('user_id', $user_id)->first();

					$firstname 	= $linkedinuser->linkedin_firstname;
					$lastname 	= $linkedinuser->linkedin_lastname;
					$email 		= $linkedinuser->linkedin_email;

					//return var_dump($linkedinuser);				
					break;
				
				default:
					return "There was an error with getAutofillFetched() oauth_client switch. 
							Please report this to the WebOps Team.";
					break;
			}

			// Add any Data that needs to be added from other Imported Tables here.
			$phone = $this->getPhonenumberWilkommen($email);

			// Save Basic Info Data in basic_infos using
			$userdata = BasicInfo::create(array(
				'user_id'	=> $user_id,				
				'firstname' => $firstname,			
				'lastname'	=> $lastname,
				'email'		=> $email,
				'phone'		=> $phone
			));

			// Redirecting to Basic Info instead of Home Page.
			return Redirect::route('basic-info');

			//return Redirect::route('home');
				
		}		
	}

	/* Fetch Roll Number from Wilkommen based on Email ID */
	public function getRollnumberWilkommen($emailid) {
		$getRollnumberWilkommen = DB::table('import_wilkommen')->where('emailid', $emailid)->first();
		if(!is_null($getRollnumberWilkommen)) {	
			$rollnumberCaps = strtoupper($getRollnumberWilkommen->rollnumber);
			return $rollnumberCaps;	
		} else { 
			return "";
		}
		return $emailid;
	}
	/* Fetch Phone Number from Wilkommen based on Email ID */
	public function getPhonenumberWilkommen($emailid) {
		$getPhonenumberWilkommen = DB::table('import_wilkommen')->where('emailid', $emailid)->first();
		if(!is_null($getPhonenumberWilkommen)) {	
			return $getPhonenumberWilkommen->phone;	
		} else { 
			return "";
		}
		return $emailid;
	}

	/* Debug Page */
	public function getDebug() {

       	return View::make('account.debug');

	}

	/* Debug Test Page */
	public function getDebugTest() {

       	return View::make('account.test');

	}
	/* Debug Test Page (POST) */
	public function getDebugTestPost() {

		return Input::get('city');
	}

}