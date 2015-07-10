<?php

class PageController extends BaseController {

	/* Home Page (GET) */
	public function getHome()
	{	
		// START - Checklist For Left Menu
		// !DRY :( - Check alternative
		// got alternative, will update later. :)
		$user_id = Auth::id();
		$info_check = array();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['basic'] = "True";	} else { $info_check['basic'] = "False"; }
		$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
		if(!is_null($home_info)) {	$info_check['home'] = "True";	} else { $info_check['home'] = "False"; }
		$instilife_info = DB::table('instilife_infos')->where('user_id', $user_id)->first();
		if(!is_null($instilife_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);
		// END - Checklist For Left Menu

		// Will use firstname to show customized welcome message
		// NOTE: Taking variable from basic_info of Left menu checklist. Make sure to solve this dependency 
		// while drying the Code. 
		View::share('basic_info',$basic_info);

		return View::make('page.homebody');
	}

	/* ### - Basic Info */
	/* Basic Info Page (GET) */
	public function getBasicInfo()
	{
		// START - Checklist For Left Menu
		// !DRY :( - Check alternative
		$user_id = Auth::id();
		$info_check = array();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['basic'] = "True";	} else { $info_check['basic'] = "False"; }
		$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
		if(!is_null($home_info)) {	$info_check['home'] = "True";	} else { $info_check['home'] = "False"; }
		$instilife_info = DB::table('instilife_infos')->where('user_id', $user_id)->first();
		if(!is_null($instilife_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);		
		// END - Checklist For Left Menu

		$user_id = Auth::id();

		$static_departments = DB::table('static_departments')->get();
		View::share('static_departments',$static_departments);
		$static_minors = DB::table('static_minors')->get();
		View::share('static_minors',$static_minors);
		
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(is_null($basic_info)) {
			$basic_info = new stdClass();
			$basic_info->firstname = "";
			$basic_info->middlename = "";
			$basic_info->lastname = "";
			$basic_info->projectguide = "";
			$basic_info->email = "";
			$basic_info->phone = "";
			$basic_info->phonehome = "";			
			$basic_info->department = "";
			$basic_info->optionsRadiosDegree = "";
			$basic_info->graduatingyear = "";
			$basic_info->optionsRadiosFuture = "";
			$basic_info->future_field1 = "";
			$basic_info->future_field2 = "";
			$basic_info->future_field3 = "";	
			$basic_info->current_city = "";								

		} 
		View::share('basic_info',$basic_info);		

		return View::make('page.basicinfo');
	}

	/* Basic Info Page (POST) */
	public function postBasicInfo()
	{
		$validator = Validator::make(Input::all(),
			array(
				'firstname' 		=> 'required',
				'lastname'			=> 'required',
				'email'				=> 'required|email',
				'phone'				=> 'required|min:10'
			)
		);

		//return var_dump(Input::all());

		if($validator->fails()) {
			return Redirect::route('basic-info')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// Access the Basic Info
			$user_id 				= Auth::id();

			$firstname 				= Input::get('firstname');
			$middlename 			= Input::get('middlename');
			$lastname 				= Input::get('lastname');
			$department 			= Input::get('department');
			$minor 					= Input::get('minor');
			$optionsRadiosDegree 	= Input::get('optionsRadiosDegree');
			$projectguide 			= Input::get('projectguide');
			$email 					= Input::get('email');
			$phone 					= Input::get('phone');
			$phonehome 				= Input::get('phonehome');			
			$graduatingyear 		= Input::get('graduatingyear');
			$optionsRadiosFuture 	= Input::get('optionsRadiosFuture');

			if ($optionsRadiosFuture == 'Job') {
				$future_field1 		= Input::get('companyname');
				$future_field2 		= Input::get('companytitle');
				$future_field3 		= Input::get('companylocation');				
			} elseif ($optionsRadiosFuture == 'Higher Studies') {
				$future_field1 		= Input::get('universityname');
				$future_field2 		= Input::get('universitydepartment');
				$future_field3 		= Input::get('universitylocation');				
			} elseif ($optionsRadiosFuture == 'Others') {
				$future_field1 		= Input::get('futureothers');
				$future_field2		= null;
				$future_field3		= null;				
			}
			$current_city 	= Input::get('current_city');


			//var_dump(Input::all());

			// Update existing row in basic_infos if it exists. Else create new entry.
			$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
			if(!is_null($basic_info)) {

				DB::table('basic_infos')
		            ->where('user_id', $user_id)
		            ->update(array(
		            	'user_id'				=> $user_id,				
						'firstname' 			=> $firstname,			
						'middlename'			=> $middlename,
						'lastname'				=> $lastname,
						'department'			=> $department,
						'minor'					=> $minor,
						'optionsRadiosDegree'	=> $optionsRadiosDegree,
						'projectguide'			=> $projectguide,
						'email'					=> $email,
						'phone'					=> $phone,
						'phonehome'				=> $phonehome,						
						'graduatingyear'		=> $graduatingyear,
						'optionsRadiosFuture'	=> $optionsRadiosFuture,
						'future_field1'			=> $future_field1,
						'future_field2'			=> $future_field2,
						'future_field3'			=> $future_field3,
						'current_city'			=> $current_city																		
		            ));
						
				
				return Redirect::route('basic-info')
                    ->with('globalalertmessage', 'Basic Information Updated')
                    ->with('globalalertclass', 'success');
        

			} else {
				// Save Basic Info Data in basic_infos using
				$userdata = BasicInfo::create(array(
					'user_id'				=> $user_id,				
					'firstname' 			=> $firstname,			
					'middlename'			=> $middlename,
					'lastname'				=> $lastname,
					'department'			=> $department,
					'minor'					=> $minor,
					'optionsRadiosDegree'	=> $optionsRadiosDegree,
					'projectguide'			=> $projectguide,
					'email'					=> $email,
					'phone'					=> $phone,
					'phonehome'				=> $phonehome,											
					'graduatingyear'		=> $graduatingyear,
					'optionsRadiosFuture'	=> $optionsRadiosFuture,
					'future_field1'			=> $future_field1,
					'future_field2'			=> $future_field2
				));

				return Redirect::route('basic-info')
                    ->with('globalalertmessage', 'Basic Information Saved')
                    ->with('globalalertclass', 'success');
			}


			

			return Redirect::route('home');

		}
		
	}

	/* ### - Home Info */
	/* Home Info Page (GET) */
	public function getHomeInfo()
	{
		// START - Checklist For Left Menu
		// !DRY :( - Check alternative
		$user_id = Auth::id();
		$info_check = array();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['basic'] = "True";	} else { $info_check['basic'] = "False"; }
		$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
		if(!is_null($home_info)) {	$info_check['home'] = "True";	} else { $info_check['home'] = "False"; }
		$instilife_info = DB::table('instilife_infos')->where('user_id', $user_id)->first();
		if(!is_null($instilife_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);		
		// END - Checklist For Left Menu

		$user_id = Auth::id();

		$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
		if(is_null($home_info)) {
			$home_info = new stdClass();
			$home_info->fathersname = "";
			$home_info->mothersname = "";
			$home_info->permaddline1 = "";
			$home_info->permaddline2 = "";
			$home_info->permcity = "";
			$home_info->permstate = "";
			$home_info->permpincode = "";
			$home_info->permcountry = "";
			$home_info->permphonelandline = "";
			$home_info->permphonemobile = "";
			$home_info->checkboxmailadd = "";
			$home_info->mailaddline1 = "";
			$home_info->mailaddline2 = "";
			$home_info->mailcity = "";
			$home_info->mailstate = "";
			$home_info->mailpincode = "";
			$home_info->mailcountry = "";
			$home_info->mailphonelandline = "";
			$home_info->mailphonemobile = "";
		} 
		View::share('home_info',$home_info);	

		return View::make('page.homeinfo');
	}

	/* Home Info Page (POST) */
	public function postHomeInfo()
	{

		$validator = Validator::make(Input::all(),
			array(
				'fathersname' 		=> 'required',
				'mothersname'		=> 'required',
				'permaddline1'		=> 'required',
				'permcity'			=> 'required',
				'permstate'			=> 'required',
				'permpincode'		=> 'required',
				'permcountry'		=> 'required'
			)
		);

		//return var_dump(Input::all());
		if($validator->fails()) {
			return Redirect::route('home-info')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {

			// Access the Home Info
			$user_id 				= Auth::id();

			$fathersname 			= Input::get('fathersname');
			$mothersname 			= Input::get('mothersname');
			$permaddline1 			= Input::get('permaddline1');
			$permaddline2 			= Input::get('permaddline2');
			$permcity 				= Input::get('permcity');
			$permstate 				= Input::get('permstate');
			$permpincode 			= Input::get('permpincode');
			$permcountry 			= Input::get('permcountry');
			$permphonelandline 		= Input::get('permphonelandline');
			$permphonemobile 		= Input::get('permphonemobile');

			$checkboxmailadd 		= Input::get('checkboxmailadd');

			if (!$checkboxmailadd == "True") { // Include Mailing Address
				$mailaddline1 			= Input::get('mailaddline1');
				$mailaddline2 			= Input::get('mailaddline2');
				$mailcity 				= Input::get('mailcity');
				$mailstate 				= Input::get('mailstate');
				$mailpincode 			= Input::get('mailpincode');
				$mailcountry 			= Input::get('mailcountry');
				$mailphonelandline 		= Input::get('mailphonelandline');
				$mailphonemobile 		= Input::get('mailphonemobile');

				$checkboxmailadd = "False";
			}

			if ($checkboxmailadd == "True") { // Don't Include Mailing Address while Saving

				// Update existing row in home_infos if it exists. Else create new entry.
				$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
				if(!is_null($home_info)) {

					DB::table('home_infos')
			            ->where('user_id', $user_id)
			            ->update(array(
			            	'user_id'				=> $user_id,				
							'fathersname' 			=> $fathersname,			
							'mothersname'			=> $mothersname,
							'permaddline1'			=> $permaddline1,
							'permaddline2'			=> $permaddline2,
							'permcity'				=> $permcity,
							'permstate'				=> $permstate,
							'permpincode'			=> $permpincode,
							'permcountry'			=> $permcountry,
							'permphonelandline'		=> $permphonelandline,
							'permphonemobile'		=> $permphonemobile,
							'checkboxmailadd'		=> $checkboxmailadd
							
			            ));
							
					return Redirect::route('home-info')
                    	->with('globalalertmessage', 'Home Information Updated')
                    	->with('globalalertclass', 'success');

				} else { 

					// Save Home Info Data in home_infos using
					$userdata = HomeInfo::create(array(
						'user_id'				=> $user_id,				
						'fathersname' 			=> $fathersname,			
						'mothersname'			=> $mothersname,
						'permaddline1'			=> $permaddline1,
						'permaddline2'			=> $permaddline2,
						'permcity'				=> $permcity,
						'permstate'				=> $permstate,
						'permpincode'			=> $permpincode,
						'permcountry'			=> $permcountry,
						'permphonelandline'		=> $permphonelandline,
						'permphonemobile'		=> $permphonemobile,
						'checkboxmailadd'		=> $checkboxmailadd
					));

					return Redirect::route('home-info')
                    	->with('globalalertmessage', 'Home Information Saved')
                    	->with('globalalertclass', 'success');
				}

			} else { // Include Mailing Address while Saving

				// Update existing row in home_infos if it exists. Else create new entry.
				$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
				if(!is_null($home_info)) {

					DB::table('home_infos')
			            ->where('user_id', $user_id)
			            ->update(array(
			            	'user_id'				=> $user_id,				
							'fathersname' 			=> $fathersname,			
							'mothersname'			=> $mothersname,
							'permaddline1'			=> $permaddline1,
							'permaddline2'			=> $permaddline2,
							'permcity'				=> $permcity,
							'permstate'				=> $permstate,
							'permpincode'			=> $permpincode,
							'permcountry'			=> $permcountry,
							'permphonelandline'		=> $permphonelandline,
							'permphonemobile'		=> $permphonemobile,
							'checkboxmailadd'		=> $checkboxmailadd,

							'mailaddline1'			=> $mailaddline1,
							'mailaddline2'			=> $mailaddline2,
							'mailcity'				=> $mailcity,
							'mailstate'				=> $mailstate,
							'mailpincode'			=> $mailpincode,
							'mailcountry'			=> $mailcountry,
							'mailphonelandline'		=> $mailphonelandline,
							'mailphonemobile'		=> $mailphonemobile
							
			            ));
							
					return Redirect::route('home-info')
                    	->with('globalalertmessage', 'Home Information Updated')
                    	->with('globalalertclass', 'success');

				} else {
					// Save Home Info Data in home_infos using
					$userdata = HomeInfo::create(array(
						'user_id'				=> $user_id,				
						'fathersname' 			=> $fathersname,			
						'mothersname'			=> $mothersname,
						'permaddline1'			=> $permaddline1,
						'permaddline2'			=> $permaddline2,
						'permcity'				=> $permcity,
						'permstate'				=> $permstate,
						'permpincode'			=> $permpincode,
						'permcountry'			=> $permcountry,
						'permphonelandline'		=> $permphonelandline,
						'permphonemobile'		=> $permphonemobile,
						'checkboxmailadd'		=> $checkboxmailadd,

						'mailaddline1'			=> $mailaddline1,
						'mailaddline2'			=> $mailaddline2,
						'mailcity'				=> $mailcity,
						'mailstate'				=> $mailstate,
						'mailpincode'			=> $mailpincode,
						'mailcountry'			=> $mailcountry,
						'mailphonelandline'		=> $mailphonelandline,
						'mailphonemobile'		=> $mailphonemobile
					));

					return Redirect::route('home-info')
                    	->with('globalalertmessage', 'Home Information Saved')
                    	->with('globalalertclass', 'success');
				}


			}

			return Redirect::route('home');

		}
	}

	/* Insti Life Info Page (GET) */
	public function getInstiLifeInfo()
	{
		// START - Checklist For Left Menu
		// !DRY :( - Check alternative
		$user_id = Auth::id();
		$info_check = array();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['basic'] = "True";	} else { $info_check['basic'] = "False"; }
		$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
		if(!is_null($home_info)) {	$info_check['home'] = "True";	} else { $info_check['home'] = "False"; }
		$instilife_info = DB::table('instilife_infos')->where('user_id', $user_id)->first();
		if(!is_null($instilife_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);		
		// END - Checklist For Left Menu

		$instilifedata = DB::table('instilife_infos')->where('user_id', $user_id)->get();
		//return var_dump($instilifedata);
		if(!is_null($instilife_info)) {
			View::share('instilifedata',$instilifedata);		
		}

		//var_dump($instilifedata);

		return View::make('page.instilifeinfo');
	}

	/* Insti Life Info Page (DELETE) */
	public function deleteInstilifeInfo()
	{
		$user_id = Auth::id();

		$por_id = Input::get('por_id');
		$instilife_info = DB::table('instilife_infos')
		->where('id', $por_id)
		->where('user_id', $user_id)->first();
		if(!is_null($instilife_info)) {
				
				DB::table('instilife_infos')
					->where('id', $por_id)
					->where('user_id', $user_id)
					->delete();
				return "PoR deleted";

		} else {
				
				return "Requested PoR doesn't Exist";
		}

		return "Delete request received";

	}

	/* Insti Life Info Page (POST) */
	public function postInstilifeInfo()
	{
		$validator = Validator::make(Input::all(),
			array(
				'instilifeinfodata' => 'required'			
			)
		);

		//return var_dump(Input::all());
		if($validator->fails()) {
			return Redirect::route('instilife-info')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {

			// Access the Insitlife Info
			$user_id = Auth::id();

			foreach (Input::get('instilifeinfodata') as $inc=>$instilifeinfodataeach) {

				$organization = $instilifeinfodataeach[0];
				$department = $instilifeinfodataeach[1];
				$post = $instilifeinfodataeach[2];

			    //foreach ($instilifeinfodataeach as $inputid=>$inputvalue) {
			        //var_dump($inputvalue);
			        //echo "<br>";
			    //}

			    // We will always create new entry will never update existing, because 
			    // there are multiple PoR's per person. 
			    // Updating will lead to replacement. 
				
				// Save Instilife Info Data in instilife_infos using
				$userdata = InstilifeInfo::create(array(
					'user_id'		=> $user_id,				
					'organization'	=> $organization,			
					'department'	=> $department,
					'post'			=> $post	
				));				

			}
			
			return Redirect::route('instilife-info')
                    ->with('globalalertmessage', 'Insti Life Information Saved')
                    ->with('globalalertclass', 'success');


		}
		
		return Redirect::route('home');

	}

	/* Social Media Info Page (GET) */
	public function getSocialMediaInfo()
	{
		// START - Checklist For Left Menu
		// !DRY :( - Check alternative
		$user_id = Auth::id();
		$info_check = array();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['basic'] = "True";	} else { $info_check['basic'] = "False"; }
		$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
		if(!is_null($home_info)) {	$info_check['home'] = "True";	} else { $info_check['home'] = "False"; }
		$instilife_info = DB::table('instilife_infos')->where('user_id', $user_id)->first();
		if(!is_null($instilife_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);		
		// END - Checklist For Left Menu

		$user_id = Auth::id();

		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(is_null($socialmedia_info)) {
			$socialmedia_info = new stdClass();
			$socialmedia_info->googleplusprofilelink = "";
			$socialmedia_info->linkedinprofilelink = "";
			$socialmedia_info->facebookprofilelink = "";			

		} 
		View::share('socialmedia_info',$socialmedia_info);		

		return View::make('page.socialmediainfo');
	}

	/* Social Media Info Page (POST) */
	public function postSocialmediaInfo()
	{
		$validator = Validator::make(Input::all(),
			array(
							
			)
		);

		//return var_dump(Input::all());
		if($validator->fails()) {
			return Redirect::route('socialmedia-info')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {

			// Access the Socialmedia Info
			$user_id 				= Auth::id();

			$googleplusprofilelink	= Input::get('googleplusprofilelink');
			$linkedinprofilelink 	= Input::get('linkedinprofilelink');
			$facebookprofilelink 	= Input::get('facebookprofilelink');

			// Update existing row in socialmedia_infos if it exists. Else create new entry.
			$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
			if(!is_null($socialmedia_info)) {

				DB::table('socialmedia_infos')
		            ->where('user_id', $user_id)
		            ->update(array(
		            	'user_id'				=> $user_id,				
						'googleplusprofilelink' => $googleplusprofilelink,			
						'linkedinprofilelink'	=> $linkedinprofilelink,
						'facebookprofilelink'	=> $facebookprofilelink						
		            ));
						
				
				return Redirect::route('socialmedia-info')
                    ->with('globalalertmessage', 'Social Media Information Updated')
                    ->with('globalalertclass', 'success');
        

			} else {
				// Save Socialmedia Info Data in socialmedia_infos using
				$userdata = SocialmediaInfo::create(array(
					'user_id'				=> $user_id,				
					'googleplusprofilelink' => $googleplusprofilelink,			
					'linkedinprofilelink'	=> $linkedinprofilelink,
					'facebookprofilelink'	=> $facebookprofilelink	
				));

				return Redirect::route('socialmedia-info')
                    ->with('globalalertmessage', 'Social Media Information Saved')
                    ->with('globalalertclass', 'success');
			}

			return Redirect::route('home');

		}
	}

	/* Home Page (GET) */
	public function getAboutUs()
	{
		$user = DB::table('users')->orderBy('created_at', 'desc')->first();
		$usercount = (int) $user->id;
		//return $usercount;
		View::share('usercount', $usercount);		

		return View::make('page.aboutus');		
	}

	/* Privacy Policy Page (GET) */
	public function getPrivacyPolicy()
	{	

		return View::make('page.privacypolicy');		
	}

	/* Report Issues (GET) */
	public function getReportIssues()
	{
		return View::make('page.reportissues');		
	}

	### OAUTH SETTINGS
	/* Oauth Settings (GET) */
	public function getOauthSettings()
	{
		$user_id = Auth::id();
		$oauth_check = array();		
		$googleplus_info = DB::table('googleplus_users')->where('user_id', $user_id)->first();
		if(!is_null($googleplus_info)) { $oauth_check['googleplus'] = "True"; } else { $oauth_check['googleplus'] = "False"; }
		$linkedin_info = DB::table('linkedin_users')->where('user_id', $user_id)->first();
		if(!is_null($linkedin_info)) { $oauth_check['linkedin'] = "True"; } else { $oauth_check['linkedin'] = "False"; }
		$facebook_info = DB::table('facebook_users')->where('user_id', $user_id)->first();
		if(!is_null($facebook_info)) { $oauth_check['facebook'] = "True"; } else { $oauth_check['facebook'] = "False"; }
		
		$user_email_info = DB::table('user_emails')->where('user_id', $user_id)->first();
		View::share('user_email_info', $user_email_info);		

		View::share('googleplus_info', $googleplus_info);		
		View::share('linkedin_info', $linkedin_info);		
		View::share('facebook_info', $facebook_info);						

		View::share('oauth_check', $oauth_check);		

		// Check if User has Admin Access
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		return View::make('page.oauthsettings');		
	}

	/* Oauth Settings (DELETE) */
	public function deleteOauthSettings()
	{
		$user_id = Auth::id();

		$oauthclient = Input::get('oauthclient');
		switch ($oauthclient) {
			case 'googleplus':
	        	$googleplususer = GoogleplusUser::where('user_id', '=', $user_id)->first();
	        	$googleplususer->delete();
	        	return "Googleplus Oauth Account Deleted";
				break;
			case 'linkedin':
				$linkedinuser = LinkedinUser::where('user_id', '=', $user_id)->first();
	        	$linkedinuser->delete();
	        	return "Linkedin Oauth Account Deleted";
				break;
			case 'facebook':
				$facebookuser = FacebookUser::where('user_id', '=', $user_id)->first();
	        	$facebookuser->delete();
	        	return "Facebook Oauth Account Deleted";
				break;
			
			default:
				return "No Oauth Detected. Contact Webops Team";
				break;
		}

	}

	/* Events Page (GET) */
	public function getEvents()
	{
		$events = DB::table('events')->where('event_status', "Open")
			->orderBy('event_id', 'desc')
			->get();
		View::share('events', $events);		

		// Concluding Basic Infos has been filled if Graduating Year entry exists in DB for that user
		$user_id = Auth::id();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!empty($basic_info->graduatingyear)) {	$basic_info_check = "True";	} else { $basic_info_check = "False"; }
		View::share('basic_info_check', $basic_info_check);				

		// Check if User has Admin Access
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);		

		return View::make('page.events');		
	}

	/* Events Name Page (GET) */
	public function getEventsName($event_unique_name)
	{
		$event = DB::table('events')->where('event_unique_name', $event_unique_name)->first();
		if(!is_null($event)) {	
			//return "Event Found"; 
		} else { 
			return "Event Not Found";
		}		
		View::share('event', $event);		

		// Concluding Basic Infos has been filled if Graduating Year entry exists in DB for that user
		$user_id = Auth::id();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!empty($basic_info->graduatingyear)) {	
			$basic_info_check = "True";	
		} else { 
			$basic_info_check = "False"; 
			return Redirect::route('events')
                    ->with('globalalertmessage', 'Please fill Basic Information Form before proceeding')
                    ->with('globalalertclass', 'error');
		}
		View::share('basic_info', $basic_info);				
		
		$eventattendance = DB::table('events_attendance')
			->where('user_id', $user_id)
			->where('event_id', $event->event_id)			
			->first();
		if(!empty($eventattendance)) {	
			$eventattendance_check = "True";	
		} else { 
			$eventattendance_check = "False"; 			
		}
		View::share('eventattendance_check', $eventattendance_check);		

		$events_specific_questions = DB::table('events_specific_questions')
			->where('event_id', $event->event_id)			
			->get(); 
		//return dd($events_specific_questions);
		View::share('events_specific_questions', $events_specific_questions);	

		$events_specific_questions_answers = DB::table('events_specific_questions_answers')
			->where('event_id', $event->event_id)
			->where('user_id', $user_id)			
			->get(); 
		View::share('events_specific_questions_answers', $events_specific_questions_answers);	
		//dd($events_specific_questions_answers);

		return View::make('page.eventsname');		
	}

	/* Events Attendance Page (POST) */
	public function postEventsAttendance(){
		$user_id = Auth::id();		
		$event_id = Input::get('event_id');
		$event_unique_name = "";
		$event_survey_status = "";		

		// Save Basic Info Data in basic_infos using
				$eventsattendance = EventsAttendance::create(array(
					'user_id'				=> $user_id,				
					'event_id' 				=> $event_id,			
					'event_unique_name'		=> $event_unique_name,
					'event_survey_status'	=> $event_survey_status					
				));

		return "Your Attendance has been Confirmed";
	}

	/* Events Attendance Page (DELETE) */
	public function deleteEventsAttendance(){
		$user_id = Auth::id();		
		$event_id = Input::get('event_id');
		
		$eventsattendance = EventsAttendance::where('user_id', '=', $user_id)
			->where('event_id', '=', $event_id)
			->first();
		$eventsattendance->delete();

		return "Your Attendance has been Cancelled";
	}
	
	/* Events Questions Anwsers Page (POST) */
	public function postEventsQuestionsAnwsers(){

		$user_id = Auth::id();		
		$event_id = Input::get('event_id');
		$event_unique_name = Input::get('event_unique_name');

		$events_specific_questions = DB::table('events_specific_questions')
			->where('event_id', $event_id)			
			->get(); 
		$events_specific_questions_count = (int)count((array)$events_specific_questions);
		//var_dump(Input::all());
		for ($i=1; $i <= $events_specific_questions_count ; $i++) { 
			//echo "Number : ".$i ;
			// Save Basic Info Data in basic_infos using
			$events_specific_questions_answers = EventsSpecificQuestionsAnswers::create(array(
				'user_id'		=> $user_id,				
				'event_id' 		=> $event_id,			
				'question_id'	=> $i,
				'answer_value'	=> Input::get($i)
			));
		}

		return Redirect::to('/events/'.$event_unique_name.'/')
                    ->with('globalalertmessage', 'Event Specific Questions Answered')
                    ->with('globalalertclass', 'success');
	
	}

	/* Admin Page (GET) */
	public function getAdmin(){
		$user_id = Auth::id();		
		
		// Check if User has Admin Access		
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		return View::make('admin.adminhome');				

	}

	/* Admin Event Management Page (GET) */
	public function getAdminEventManagement(){
		$user_id = Auth::id();		
		
		// Check if User has Admin Access		
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);	

		$events = DB::table('events')
			->orderBy('id', 'desc')
			->get();
		View::share('events', $events);		


		return View::make('admin.eventmanagement');				
	}

	/* Admin Events Name Registered Users Page (GET) */
	public function getAdminEventsNameRegisteredUsers($event_unique_name)
	{	
		// Check if User has Admin Access		
		$user_id = Auth::id();				
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);	

		$event = DB::table('events')->where('event_unique_name', $event_unique_name)->first();
		if(!is_null($event)) {	
			//return "Event Found"; 
		} else { 
			return "Event Not Found";
		}		
		View::share('event', $event);

		$event_attendance_users = DB::table('events_attendance')
			->where('event_id', $event->event_id)			
			->get();
		foreach ($event_attendance_users as $key => $event_attendance_user) {
			$event_attendance_user->user_registeration_number = $key + 1;
			$registered_user = User::find($event_attendance_user->user_id);
			$event_attendance_user->user_roll_number = $registered_user->rollno;
			$registered_user_basic_info = BasicInfo::where('user_id', '=', $event_attendance_user->user_id)->first();
			$event_attendance_user->user_name 		= $registered_user_basic_info->firstname . " " . $registered_user_basic_info->lastname;
			$event_attendance_user->user_email 		= $registered_user_basic_info->email;
			$event_attendance_user->user_phone 		= $registered_user_basic_info->phone;
			$event_attendance_user->user_phonehome 	= $registered_user_basic_info->phonehome;			
			$event_attendance_user->user_graduatingyear = $registered_user_basic_info->graduatingyear;
			$event_attendance_user->user_future_field1 = $registered_user_basic_info->future_field1;
			$event_attendance_user->user_future_field2 = $registered_user_basic_info->future_field2;
			$event_attendance_user->user_future_field3 = $registered_user_basic_info->future_field3;

		}
		View::share('event_attendance_users', $event_attendance_users);		

		return View::make('admin.eventmanagement_registeredusers');				

	}

	/* Admin Events Name Registered Users Excel Page (GET) */
	public function getAdminEventsNameRegisteredUsersExcel($event_unique_name)
	{
		// Data Generation
		// Check if User has Admin Access		
		$user_id = Auth::id();				
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} 
		else { $admin_user_check = "False"; return "Your Access Level is Not Admin."; }				

		$event = DB::table('events')->where('event_unique_name', $event_unique_name)->first();
		if(!is_null($event)) {	
			//return "Event Found"; 
		} else { 
			return "Event Not Found";
		}		

		$event_attendance_users = DB::table('events_attendance')
			->where('event_id', $event->event_id)			
			->get();
		foreach ($event_attendance_users as $key => $event_attendance_user) {
			$event_attendance_user->user_registeration_number = $key + 1;
			$registered_user = User::find($event_attendance_user->user_id);
			$event_attendance_user->user_roll_number = $registered_user->rollno;
			$registered_user_basic_info = BasicInfo::where('user_id', '=', $event_attendance_user->user_id)->first();
			$event_attendance_user->user_name 		= $registered_user_basic_info->firstname . " " . $registered_user_basic_info->lastname;
			$event_attendance_user->user_email 		= $registered_user_basic_info->email;
			$event_attendance_user->user_phone 		= $registered_user_basic_info->phone;
			$event_attendance_user->user_phonehome 	= $registered_user_basic_info->phonehome;			
			$event_attendance_user->user_graduatingyear = $registered_user_basic_info->graduatingyear;
			$event_attendance_user->user_university = $registered_user_basic_info->future_field1;
			$event_attendance_user->user_department = $registered_user_basic_info->future_field2;

			$events_specific_questions = DB::table('events_specific_questions')
				->where('event_id', $event->event_id)			
				->get(); 
			//return dd($events_specific_questions);


		    foreach ($events_specific_questions as $ESQkey => $events_specific_question) {
		    	$registered_user_events_specific_questions_answers = EventsSpecificQuestionsAnswers::where('user_id', '=', $event_attendance_user->user_id)
					->where('event_id', '=', $event->event_id)
					->where('question_id', '=', $ESQkey+1)				
					->get();
					foreach ($registered_user_events_specific_questions_answers as $ESQAkey => $registered_user_events_specific_questions_answer) {
			    		$event_attendance_user->{$events_specific_question->question_value} = $registered_user_events_specific_questions_answer->answer_value;						
						//return dd($registered_user_events_specific_questions_answer->answer_value);
					}
		    }



			

			//$event_attendance_user->events_specific_questions_answers = $registered_user_events_specific_questions_answers;
			
			
			$event_attendance_user_array_row = (array) $event_attendance_user;
			$event_attendance_user_array_row_delete = array_splice($event_attendance_user_array_row, 0, 6);

			$event_attendance_user_array[] = $event_attendance_user_array_row;
		}
		$data = (array) $event_attendance_user_array;

		//var_dump($event_attendance_users);
		//dd($data);

		// Excel Generation
		Excel::create($event_unique_name.'_registeredusers', function($excel) use($data) {

		    // Set the title
		    $excel->setTitle('Data Exported to Excel Format');

		    // Chain the setters
		    $excel->setCreator('Yash Murty')
		          ->setCompany('Yash Murty, yashmurty@gmail.com');

		    // Call them separately
		    $excel->setDescription('Data exported to Excel Format. In case of any
		    	problems please contact yashmurty@gmail.com');

		    $excel->sheet('Registered Users', function($sheet) use($data) {

		        // Sheet manipulation
		        $sheet->fromArray($data);

		    });

		})->export('xls');
		
		//})->export('xls');

		// or
		//->download('xls');
		
		return "Excel";
	}

	/* Admin Events Name Registered Users Responses Page (GET) */
	public function getAdminEventsNameRegisteredUsersResponses($event_unique_name)
	{	
		// Check if User has Admin Access		
		$user_id = Auth::id();				
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);	

		$event = DB::table('events')->where('event_unique_name', $event_unique_name)->first();
		if(!is_null($event)) {	
			//return "Event Found"; 
		} else { 
			return "Event Not Found";
		}		
		View::share('event', $event);

		$events_specific_questions = DB::table('events_specific_questions')
			->where('event_id', $event->event_id)			
			->get(); 
		//return dd($events_specific_questions);
		View::share('events_specific_questions', $events_specific_questions);	


		$event_attendance_users = DB::table('events_attendance')
			->where('event_id', $event->event_id)			
			->get();
		foreach ($event_attendance_users as $key => $event_attendance_user) {
			$event_attendance_user->user_registeration_number = $key + 1;
			$registered_user = User::find($event_attendance_user->user_id);
			$event_attendance_user->user_roll_number = $registered_user->rollno;

			$registered_user_basic_info = BasicInfo::where('user_id', '=', $event_attendance_user->user_id)->first();
			$event_attendance_user->user_name 		= $registered_user_basic_info->firstname . " " . $registered_user_basic_info->lastname;
			$event_attendance_user->user_email 		= $registered_user_basic_info->email;
			$event_attendance_user->user_phone 		= $registered_user_basic_info->phone;
			$event_attendance_user->user_phonehome 	= $registered_user_basic_info->phonehome;			
			$event_attendance_user->user_graduatingyear = $registered_user_basic_info->graduatingyear;
			$event_attendance_user->user_future_field1 = $registered_user_basic_info->future_field1;
			$event_attendance_user->user_future_field2 = $registered_user_basic_info->future_field2;
			$event_attendance_user->user_future_field3 = $registered_user_basic_info->future_field3;

			$registered_user_events_specific_questions_answers = EventsSpecificQuestionsAnswers::where('user_id', '=', $event_attendance_user->user_id)
				->where('event_id', '=', $event->event_id)
				->get();
			$event_attendance_user->events_specific_questions_answers = $registered_user_events_specific_questions_answers;
			/*
			var_dump($event_attendance_user->events_specific_questions_answers);

			foreach ($event_attendance_user->events_specific_questions_answers as $key => $events_specific_questions_answer) {
				var_dump($events_specific_questions_answer->answer_value);
				echo "<hr>";
			}
			*/
			//$event_attendance_user->user_future_field3 = $registered_user_events_specific_questions_answers->answer_value;

			foreach ($events_specific_questions as $ESQkey => $events_specific_question) {
			//	return $events_specific_question->question_id;
			}
		}
		View::share('event_attendance_users', $event_attendance_users);		

		

		return View::make('admin.eventmanagement_registeredusers_responses');				

	}

	/* Admin Events Name Edit Page (GET) */
	public function getAdminEventsNameEdit($event_unique_name)
	{	
		// Check if User has Admin Access		
		$user_id = Auth::id();				
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);	

		$event = DB::table('events')->where('event_unique_name', $event_unique_name)->first();
		if(!is_null($event)) {	
			//return "Event Found"; 
		} else { 
			return "Event Not Found";
		}		
		View::share('event', $event);

		return View::make('admin.eventmanagement_edit');				

	}

	/* Admin Events Name Edit Page (GET) */
	public function postAdminEventsNameEdit()
	{
		return Input::all();
	}

	/* Admin User Management Page (GET) */
	public function getAdminUserManagement(){
		$user_id = Auth::id();		
		
		// Check if User has Admin Access		
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }				
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);	

		$users = DB::table('users')->get();
		foreach ($users as $key => $user) {
			$user_basic_info = BasicInfo::where('user_id', '=', $user->id)->first();
			$user->user_name 			= $user_basic_info->firstname . " " . $user_basic_info->lastname;
			$user->user_email 			= $user_basic_info->email;
			$user->user_phone 			= $user_basic_info->phone;
			$user->user_phonehome 		= $user_basic_info->phonehome;			
			$user->user_graduatingyear 	= $user_basic_info->graduatingyear;
			$user->user_university 		= $user_basic_info->future_field1;
			$user->user_department 		= $user_basic_info->future_field2;
			$user->serial_number		= $key + 1;
		}
		View::share('users', $users);		

		return View::make('admin.usermanagement');				
	}

	/* Admin Event Management - Create New Event (POST) */
	public function postAdminEventManagement(){
	
		$validator = Validator::make(Input::all(),
			array(
				'event_name' => 'required',
				'event_unique_name' => 'required'					
			)
		);

		//return var_dump(Input::all());
		if($validator->fails()) {
			return Redirect::route('admin-event-management')
				->withErrors($validator)
				->with('globalalertmessage', 'Please Fill all the required Information')
				->with('globalalertclass', 'error')
				->withInput();   // fills the field with the old inputs what were correct

		} else {

			//return Input::all();
			$event_name = Input::get('event_name');
			$event_unique_name = Input::get('event_unique_name');

			$event_info = DB::table('events')->where('event_unique_name', $event_unique_name)->first();
			if(!is_null($event_info)) {
				return Redirect::route('admin-event-management')
					->with('globalalertmessage', 'Event Unique Name already taken')
					->with('globalalertclass', 'error');
			} else {

				// Access the Insitlife Info
				$user_id = Auth::id();

				$events = DB::table('events')
							->orderBy('event_id', 'desc')
							->first();
				//dd($events);
				$event_id = $events->event_id + 1;

				// Save Basic Info Data in basic_infos using
				$event = EventsModel::create(array(
					'user_id'				=> $user_id,				
					'event_id' 				=> $event_id,			
					'event_unique_name'		=> $event_unique_name,
					'event_name'			=> $event_name,
					'event_status'			=> 'Closed',
					'event_rsvp_status'		=> 'Closed'
				));

				return Redirect::route('admin-event-management')
					->with('globalalertmessage', 'Event Successfully created')
					->with('globalalertclass', 'success');
			}
		}
	}


	/* Search Box (POST) */
	public function postSearchBox()
	{
		$user_id = Auth::id();		
		$searchboxvalues = array();

		$users = DB::table('users')->get();
		foreach ($users as $key => $user) {
			$user_basic_info = BasicInfo::where('user_id', '=', $user->id)->first();
			$user->user_name 			= $user_basic_info->firstname . " " . $user_basic_info->lastname;
			$user->user_email 			= $user_basic_info->email;
			$user->user_phone 			= $user_basic_info->phone;
			$user->user_phonehome 		= $user_basic_info->phonehome;			
			$user->user_graduatingyear 	= $user_basic_info->graduatingyear;
			$user->user_university 		= $user_basic_info->future_field1;
			$user->user_department 		= $user_basic_info->future_field2;
			$user->serial_number		= $key + 1;

			//$searchboxvalues[] = "name: $user->user_name";
			//$tokens = array("$user_basic_info->firstname","$user_basic_info->lastname");
			$searchboxvalues[] = array('value' => $user->rollno . " " . $user->user_name, 'rollno' => $user->rollno, 'username' => $user->user_name);

		}

		header('Content-Type: application/json');
		json_encode($searchboxvalues);

		return $searchboxvalues;
	}

}
