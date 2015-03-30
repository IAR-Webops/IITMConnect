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
	        $result = json_decode( $fb->request( '/me' ), true );	        
			$result['accesstoken'] = $accesstoken;	      
	        //Var_dump
	        //display whole array().
	        //dd($result);

	        View::share('result',$result);

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
						'facebook_email'		=> $result['email'],
						'facebook_accesstoken'	=> $result['accesstoken']
					));
	        	}

	        	return Redirect::route('home');

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
				'facebook_email'		=> 'required',
				'facebook_accesstoken'	=> 'required',
				'rollno'				=> 'required|min:1'
			)
		);

		if($validator->fails()) {
			return Redirect::route('account-sign-in-facebook')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// create an account
			$facebook_id 			= Input::get('facebook_id');
			$facebook_name 			= Input::get('facebook_name');
			$facebook_email 		= Input::get('facebook_email');
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
				'facebook_email'		=> $facebook_email,
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

		return Redirect::route('home');

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
			$result['accesstoken'] = $accesstoken;	      

	        //Var_dump
	        //display whole array().
	        //dd($result);

			View::share('result',$result);

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
						'googleplus_email'			=> $result['email'],
						'googleplus_link'			=> $result['link'],
						'googleplus_picture'		=> $result['picture'],
						'googleplus_gender'			=> $result['gender'],
						'googleplus_accesstoken'	=> $result['accesstoken']						
					));
	        	}

	        	return Redirect::route('home');

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
				'googleplus_email'			=> 'required',
				'googleplus_link'			=> 'required',
				'googleplus_picture'		=> 'required',
				'googleplus_gender'			=> 'required',
				'googleplus_accesstoken'	=> 'required',				
				'rollno'					=> 'required|min:1'
			)
		);

		if($validator->fails()) {
			return Redirect::route('account-sign-in-googleplus')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// create an account
			$googleplus_id 			= Input::get('googleplus_id');
			$googleplus_name 		= Input::get('googleplus_name');
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

		return Redirect::route('home');

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
			$result['name'] = $result['firstName'] . " " . $result['lastName'];
			$result['accesstoken'] = $accesstoken;	      

		    //Var_dump
		    //display whole array().
		    //return $result['siteStandardProfileRequest']['url'];
		    //dd($result);

			View::share('result',$result);

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
						'linkedin_email'		=> $result['emailAddress'],
						'linkedin_link'			=> $result['siteStandardProfileRequest']['url'],
						'linkedin_picture'		=> $result['pictureUrl'],
						'linkedin_headline'		=> $result['headline'],
						'linkedin_accesstoken'	=> $result['accesstoken']						
					));
	        	}

	        	return Redirect::route('home');

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
				'linkedin_email'		=> 'required',
				'linkedin_link'			=> 'required',
				'linkedin_picture'		=> 'required',
				'linkedin_headline'		=> 'required',
				'linkedin_accesstoken'	=> 'required',				
				'rollno'				=> 'required|min:1'
			)
		);

		if($validator->fails()) {
			return Redirect::route('account-sign-in-linkedin')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// create an account
			$linkedin_id 			= Input::get('linkedin_id');
			$linkedin_name 			= Input::get('linkedin_name');
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

		return Redirect::route('home');

	}

}  