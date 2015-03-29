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

			// Save Facebook Data in facebook_users
			$userdata = FacebookUser::create(array(
				'user_id'				=> $user_id,				
				'facebook_id' 			=> $facebook_id,			
				'facebook_name'			=> $facebook_name,
				'facebook_email'		=> $facebook_email,
				'facebook_accesstoken'	=> $facebook_accesstoken
			));

			// Save User's Email in user_email
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

}  