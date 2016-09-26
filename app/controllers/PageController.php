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
		$static_hostels = DB::table('static_hostels')->get();
		View::share('static_hostels',$static_hostels);

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
			$basic_info->hostel = "";
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
			$hostel 				= Input::get('hostel');
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
						'hostel'				=> $hostel,
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
					'hostel'				=> $hostel,
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
			$address = $event->event_place;
			$address = preg_replace('/\s+/', '+', $address);
			$event->event_search_url = "https://www.google.co.in/maps/place/".$address."";
			$event->event_place_url = "https://maps.googleapis.com/maps/api/staticmap?center=".$address."&zoom=14&size=640x640&scale=1&markers=color:blue|".$address."";
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
		foreach ($events_specific_questions as $key => $events_specific_question) {
			# code...
			$events_specific_questions_answer = DB::table('events_specific_questions_answers')
											->where('event_id', $event->event_id)
											->where('user_id', $user_id)
											->where('question_id', $events_specific_question->question_id)
											->orderBy('id', 'desc')
											->first();
			if(empty($events_specific_questions_answer)) {
				$events_specific_questions_answer = new stdClass();
				$events_specific_questions_answer->answer_value = null;
			}
			$events_specific_question->events_specific_questions_answer = $events_specific_questions_answer;
			// var_dump($events_specific_question);
		}
		// return dd($events_specific_questions);
		View::share('events_specific_questions', $events_specific_questions);

		$events_specific_questions_answers = DB::table('events_specific_questions_answers')
			->where('event_id', $event->event_id)
			->where('user_id', $user_id)
			->get();
		View::share('events_specific_questions_answers', $events_specific_questions_answers);
		// dd($events_specific_questions_answers);

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
			$event_attendance_user->hostel 			= $registered_user_basic_info->hostel;
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


	/* Admin Events Name Edit Page (POST) */
	public function postAdminEventsNameEdit($event_unique_name)
	{
		//return Input::all();

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

			$event_name 			= Input::get('event_name');
			$event_details_short 	= Input::get('event_details_short');
			$event_details 			= Input::get('event_details');
			$event_picture 			= Input::get('event_picture');
			$event_date 			= Input::get('event_date');
			$event_time				= Input::get('event_time');
			$event_place 			= Input::get('event_place');
			$event_fb_event_link 	= Input::get('event_fb_event_link');
			$event_organizer 		= Input::get('event_organizer');
			$event_status 			= Input::get('event_status');
			$event_rsvp_status 		= Input::get('event_rsvp_status');
			$event_has_questions 	= Input::get('event_has_questions');

			if (is_null($event_status)) {
				$event_status = "Closed";
			} else {
				$event_status = "Open";
			}
			if (is_null($event_rsvp_status)) {
				$event_rsvp_status = "Closed";
			} else {
				$event_rsvp_status = "Open";
			}
			if (is_null($event_has_questions)) {
				$event_has_questions = "No";
			} else {
				$event_has_questions = "Yes";
			}


			// Update existing row in basic_infos if it exists. Else create new entry.
			$event = DB::table('events')->where('event_unique_name', $event_unique_name)->first();
			if(!is_null($event)) {

				DB::table('events')
		            ->where('event_unique_name', $event_unique_name)
		            ->update(array(
		            	'event_name'			=> $event_name,
		            	'event_url'				=> $event_unique_name,
						'event_details_short' 	=> $event_details_short,
						'event_details'			=> $event_details,
						'event_picture'			=> $event_picture,
						'event_date'			=> $event_date,
						'event_time'			=> $event_time,
						'event_place'			=> $event_place,
						'event_fb_event_link'	=> $event_fb_event_link,
						'event_organizer'		=> $event_organizer,
						'event_status'			=> $event_status,
						'event_rsvp_status'		=> $event_rsvp_status,
						'event_has_questions'	=> $event_has_questions
		            ));


				return Redirect::route('admin-event-management')
	                ->with('globalalertmessage', 'Event Information Updated')
	                ->with('globalalertclass', 'success');


			} else {

				return Redirect::route('admin-event-management')
	                ->with('globalalertmessage', 'Event Not Found')
	                ->with('globalalertclass', 'error');
			}

		}

	}


	/* Admin Events Name Delete Page (POST) */
	public function postAdminEventsNameDelete($event_unique_name)
	{
		//return Input::all();

		$validator = Validator::make(Input::all(),
			array(
				'event_name' 		=> 'required',
				'event_unique_name' => 'required'
			)
		);

		//return var_dump(Input::all());
		if($validator->fails()) {
			return Redirect::route('admin-event-management')
				->withErrors($validator)
				->with('globalalertmessage', 'Delete Failed')
				->with('globalalertclass', 'error')
				->withInput();   // fills the field with the old inputs what were correct

		} else {

			$event_name = Input::get('event_name');

			$deleteevent = EventsModel::where('event_unique_name', '=', $event_unique_name)
							->where('event_name', '=', $event_name)
							->first();
	        $deleteevent->delete();

	        return Redirect::route('admin-event-management')
	                ->with('globalalertmessage', 'Event Successfully Deleted')
	                ->with('globalalertclass', 'success');

		}

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

	/* Admin User Management Registered Users Excel Page (GET) */
	public function getUserManagementRegisteredUsersExcel()
	{
		// Data Generation
		// Check if User has Admin Access
		$user_id = Auth::id();
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	}
		else { $admin_user_check = "False"; return "Your Access Level is Not Admin."; }

		$users = DB::table('users')->get();
		foreach ($users as $key => $user) {
			$user_basic_info = BasicInfo::where('user_id', '=', $user->id)->first();
			$user->user_name 			= $user_basic_info->firstname . " " . $user_basic_info->lastname;
			$user->user_email 			= $user_basic_info->email;
			$user->user_phone 			= $user_basic_info->phone;
			$user->user_phonehome 		= $user_basic_info->phonehome;
			$user->hostel 				= $user_basic_info->hostel;
			$user->user_graduatingyear 	= $user_basic_info->graduatingyear;
			$user->user_university 		= $user_basic_info->future_field1;
			$user->user_department 		= $user_basic_info->future_field2;
			$user->serial_number		= $key + 1;

			$user_array_row = (array) $user;
			$user_array_row_delete = array_splice($user_array_row,2, 5);

			$user_array[] = $user_array_row;
		}



		$data = (array) $user_array;

		//var_dump($event_attendance_users);
		//dd($data);

		// Excel Generation
		Excel::create('usermanagement_registeredusers', function($excel) use($data) {

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

	/* Admin Administrators Page (GET) */
	public function getAdminAdministrators(){
		$user_id = Auth::id();

		// Check if User has Admin Access
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		// Get Administrators
		$users = DB::table('admin_users')->get();
		foreach ($users as $key => $user) {
			$user_basic_info = BasicInfo::where('user_id', '=', $user->user_id)->first();
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

		return View::make('admin.administrators');

	}

	/* Admin Oauth Management Page (GET) */
	public function getAdminOauthManagement()
	{
		$user_id = Auth::id();

		// Check if User has Admin Access
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		// Get Administrators
		$oauth_clients = DB::table('oauth_clients')->get();
		foreach ($oauth_clients as $key => $oauth_client) {
			$oauth_client_endpoint = DB::table('oauth_client_endpoints')
										->where('client_id', '=', $oauth_client->id)
										->first();
			$oauth_client->redirect_uri 	= $oauth_client_endpoint->redirect_uri;
			$oauth_developer = DB::table('oauth_developers')
										->where('client_id', '=', $oauth_client->id)
										->first();
			$oauth_client->developer_id 	= $oauth_developer->developer_id;
			$oauth_client->developer_name 	= $oauth_developer->developer_name;
			$oauth_client->developer_email 	= $oauth_developer->developer_email;

		}
		View::share('oauth_clients', $oauth_clients);

		return View::make('admin.oauthmanagement');

	}

	public function postAdminOauthManagement()
	{

		$validator = Validator::make(Input::all(),
			array(
				'app_name' 		=> 'required',
				'redirect_uri'	=> 'required',
				'developer_id'	=> 'required',
				'developer_name'=> 'required'
			)
		);

		//return var_dump(Input::all());

		if($validator->fails()) {
			return "Missing app_name or redirect_uri";
		}

		$app_name 		= Input::get('app_name');
		$redirect_uri 	= Input::get('redirect_uri');
		$developer_id 	= Input::get('developer_id');
		$developer_name = Input::get('developer_name');
		$developer_email = Input::get('developer_email');
		// $app_name 		= Input::get('app_name');

		// Generate Random client_id and client_secret
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$client_id = '';
		$client_secret = '';
		$length = 15;
		for ($i = 0; $i < $length; $i++) {
	        $client_id 		.= $characters[rand(0, $charactersLength - 1)];
	        $client_secret 	.= $characters[rand(0, $charactersLength - 1)];
	    }
	    // echo "Client ID : " . $client_id;
	    // echo "Client Secret : " . $client_secret;

	    DB::table('oauth_clients')->insert(
		    array(
		    	'id' 	=> $client_id,
		    	'secret' => $client_secret,
		    	'name' 	=> $app_name
		    	)
		);
		DB::table('oauth_client_endpoints')->insert(
		    array(
		    	'client_id' 	=> $client_id,
		    	'redirect_uri' 	=> $redirect_uri
		    	)
		);
		DB::table('oauth_developers')->insert(
		    array(
		    	'developer_id' 		=> $developer_id,
		    	'developer_name' 	=> $developer_name,
		    	'developer_email' 	=> $developer_email,
		    	'client_id' 		=> $client_id,
		    	'client_secret' 	=> $client_secret
		    	)
		);

		// return Input::all();
		if ($developer_id == "admin-oauth") {
			return Redirect::route('admin-oauthmanagement')
					->with('globalalertmessage', 'Successfully Created Oauth App')
		            ->with('globalalertclass', 'success');
		} else {
			return "success";
		}

	}

	public function postIITMDeveloperApps()
	{

		$validator = Validator::make(Input::all(),
			array(
				'developer_id'	=> 'required',
				'developer_email'=> 'required'
			)
		);

		//return var_dump(Input::all());

		if($validator->fails()) {
			return "Missing developer_id or developer_email";
		}

		$developer_id 	= Input::get('developer_id');
		$developer_email = Input::get('developer_email');

		return "Test";

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

	/* Affinity Program (GET) */
	public function getAffinityProgram()
	{
		$user_id = Auth::id();
		$info_check = array();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();

		$affinity_programs = DB::table('affinity_programs')->where('status', 'open')->get();
		// dd($affinity_programs);

		View::share('basic_info',$basic_info);
		View::share('affinity_programs',$affinity_programs);

		return View::make('page.affinityprogram');
	}

	/* Affinity Program Details (GET) */
	public function getAffinityProgramDetails($affinityprogram_unique_name)
	{
		$affinity_program = DB::table('affinity_programs')
							->where('status', 'open')
							->where('unique_name', $affinityprogram_unique_name)
							->first();

		$user_id = Auth::id();

		if(!is_null($affinity_program)) {
			// Find offers via relation
			// dd($affinity_program);
			$affinity_programs_offers = DB::table('affinity_programs_offers')
										->where('status', 'open')
										->where('affinityprogramId', $affinity_program->id)
										->get();
			// dd($affinity_programs_offers);

			$affinity_programs_registration = DB::table('affinity_programs_registrations')
											->where('status', 'approved')
											->where('affinityprogramId', $affinity_program->id)
											->where('userId', $user_id)
											->first();
			if(!is_null($affinity_programs_registration)) {
				$affinity_programs_registration_status = "true";
			} else {
				$affinity_programs_registration_status = "false";
			}
			// return $affinity_programs_registration_status;

		} else {
			// Do nothing
			$affinity_programs_offers = null;
		}

		View::share('affinity_program',$affinity_program);
		View::share('affinity_programs_offers',$affinity_programs_offers);
		View::share('affinity_programs_registration_status',$affinity_programs_registration_status);

		return View::make('page.affinityprogram_details');

	}

	/* Affinity Program Registrations (POST) */
	public function postAffinityProgramRegistration()
	{
		// return Input::all();
		$affinityprogramId 			= Input::get('affinityprogramId');
		$affinityprogram_unique_name 	= Input::get('affinityprogram_unique_name');

		$user_id = Auth::id();

		// Save Basic Info Data in basic_infos using
		$AffinityProgramRegistrationdata = AffinityProgramRegistration::create(array(
			'userId'				=> $user_id,
			'status'				=> 'approved',
			'affinityprogramId'		=> $affinityprogramId
		));

		// return Redirect::route('basic-info')
		return Redirect::to('affinityprogram/'.$affinityprogram_unique_name)
            ->with('globalalertmessage', 'Successfully applied for the Program')
            ->with('globalalertclass', 'success');

	}

	/* Admin Affinity Program (GET) */
	public function getAdminAffinityProgram()
	{
		$user_id = Auth::id();

		// Check if User has Admin Access
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		$affinity_programs = DB::table('affinity_programs')
			->orderBy('id', 'desc')
			->get();
		View::share('affinity_programs', $affinity_programs);

		return View::make('admin.affinityprogram');

	}

	/* Admin Affinity Program Registered Users (GET) */
	public function getAdminAffinityProgramRegisteredUsers($affinityprogram_unique_name)
	{
		// Check if User has Admin Access
		$user_id = Auth::id();
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		$affinity_program = DB::table('affinity_programs')->where('unique_name', $affinityprogram_unique_name)->first();
		if(!is_null($affinity_program)) {
			//return "Event Found";
		} else {
			return "Affinity Program Not Found";
		}
		View::share('affinity_program', $affinity_program);

		$affinity_programs_registrations = DB::table('affinity_programs_registrations')
			->where('affinityprogramId', $affinity_program->id)
			->get();

		foreach ($affinity_programs_registrations as $key => $affinity_programs_registrations_user) {

			$affinity_programs_registrations_user->user_registeration_number = $key + 1;
			$registered_user 										= User::find($affinity_programs_registrations_user->userId);
			$affinity_programs_registrations_user->user_roll_number = $registered_user->rollno;
			$registered_user_basic_info 							= BasicInfo::where('user_id', '=', $affinity_programs_registrations_user->userId)->first();
			$affinity_programs_registrations_user->user_name 		= $registered_user_basic_info->firstname . " " . $registered_user_basic_info->lastname;
			$affinity_programs_registrations_user->user_email 		= $registered_user_basic_info->email;
			$affinity_programs_registrations_user->user_phone 		= $registered_user_basic_info->phone;
			$affinity_programs_registrations_user->user_phonehome 	= $registered_user_basic_info->phonehome;
			$affinity_programs_registrations_user->user_graduatingyear = $registered_user_basic_info->graduatingyear;
			$affinity_programs_registrations_user->user_future_field1 = $registered_user_basic_info->future_field1;
			$affinity_programs_registrations_user->user_future_field2 = $registered_user_basic_info->future_field2;
			$affinity_programs_registrations_user->user_future_field3 = $registered_user_basic_info->future_field3;

		}

		// dd($affinity_programs_registrations);


		View::share('affinity_programs_registrations', $affinity_programs_registrations);


		return View::make('admin.affinityprogram_registeredusers');

	}

	public function postAffinityProgramManagement()
	{
		return Input::all();
	}

	/* Admin - Edit Affinity Program (GET) */
	public function getAdminAffinityProgramEdit($affinityprogram_unique_name)
	{
		// Check if User has Admin Access
		$user_id = Auth::id();
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		$affinity_program = DB::table('affinity_programs')->where('unique_name', $affinityprogram_unique_name)->first();
		if(!is_null($affinity_program)) {
			//return "Event Found";
			$affinity_programs_offers = DB::table('affinity_programs_offers')->where('affinityprogramId', $affinity_program->id)->get();
			if(is_null($affinity_programs_offers)) {
				$affinity_programs_offers = null;
			} else {
				// Do nothing
				// dd($affinity_programs_offers);
			}
		} else {
			return "Affinity Program Not Found";
		}
		View::share('affinity_program', $affinity_program);
		View::share('affinity_programs_offers', $affinity_programs_offers);

		return View::make('admin.affinityprogram_edit');
	}

	/* Admin - Edit Affinity Program (POST) */
	public function postAdminAffinityProgramEdit($affinityprogram_unique_name)
	{
		// return Input::all();
		$name 			= Input::get('name');
		$unique_name 	= Input::get('unique_name');
		$image 			= Input::get('image');
		$short_details 	= Input::get('short_details');
		$long_details	= Input::get('long_details');
		$status 		= Input::get('status');

		DB::table('affinity_programs')
			->where('unique_name', $unique_name)
			->update(array(
				'name'			=> $name,
				'image' 		=> $image,
				'short_details'	=> $short_details,
				'long_details'	=> $long_details,
				'status'		=> $status
			));

		return Redirect::route('admin-affinity-program')
			->with('globalalertmessage', 'Affinity Program Information Updated')
			->with('globalalertclass', 'success');
	}

	public function getAdminAffinityProgramOfferEdit($affinityprogram_unique_id, $affinityprogram_offer_id)
	{
		// Check if User has Admin Access
		$user_id = Auth::id();
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		$affinity_program_offer = DB::table('affinity_programs_offers')
									->where('affinityprogramId', $affinityprogram_unique_id)
									->where('id', $affinityprogram_offer_id)
									->first();
		if(!is_null($affinity_program_offer)) {
			//return "Event Found";
			// dd($affinity_program_offer);
		} else {
			return "Affinity Program Offer Not Found";
		}
		View::share('affinity_program_offer', $affinity_program_offer);

		return View::make('admin.affinityprogram_offer_edit');
	}

	public function postAdminAffinityProgramOfferEdit($affinityprogram_unique_id, $affinityprogram_offer_id)
	{
		// return Input::all();
		$name 			= Input::get('name');
		$image 			= Input::get('image');
		$short_details 	= Input::get('short_details');
		$long_details	= Input::get('long_details');
		$offer_code 		= Input::get('offer_code');
		$offer_code_message = Input::get('offer_code_message');
		$status 		= Input::get('status');


		DB::table('affinity_programs_offers')
			->where('affinityprogramId', $affinityprogram_unique_id)
			->where('id', $affinityprogram_offer_id)
			->update(array(
				'name'			=> $name,
				'image' 		=> $image,
				'short_details'	=> $short_details,
				'long_details'	=> $long_details,
				'offer_code'	=> $offer_code,
				'offer_code_message'=> $offer_code_message,
				'status'		=> $status
			));

		return Redirect::route('admin-affinity-program')
			->with('globalalertmessage', 'Affinity Program Information Updated')
			->with('globalalertclass', 'success');
	}

	public function getAdminAffinityProgramOfferNew($affinityprogram_unique_id)
	{
		// Check if User has Admin Access
		$user_id = Auth::id();
		$admin_user = AdminUser::where('user_id', '=', $user_id)
			->first();
		if(!is_null($admin_user)) {	$admin_user_check = "True";	} else { $admin_user_check = "False"; }
		View::share('admin_user',$admin_user);
		View::share('admin_user_check',$admin_user_check);

		View::share('affinityprogram_unique_id',$affinityprogram_unique_id);

		return View::make('admin.affinityprogram_offer_new');
	}

	public function postAdminAffinityProgramOfferNew($affinityprogram_unique_id)
	{
		// return Input::all();
		$name 			= Input::get('name');
		$image 			= Input::get('image');
		$short_details 	= Input::get('short_details');
		$long_details	= Input::get('long_details');
		$offer_code 		= Input::get('offer_code');
		$offer_code_message = Input::get('offer_code_message');
		$status 		= Input::get('status');

		DB::table('affinity_programs_offers')
			->insert(array(
				'name'			=> $name,
				'image' 		=> $image,
				'short_details'	=> $short_details,
				'long_details'	=> $long_details,
				'offer_code'	=> $offer_code,
				'offer_code_message'=> $offer_code_message,
				'status'		=> $status,
				'affinityprogramId' => $affinityprogram_unique_id
			));

		return Redirect::route('admin-affinity-program')
			->with('globalalertmessage', 'Affinity Program Offer Created')
			->with('globalalertclass', 'success');

	}

	public function postAdminAffinityProgramOfferDelete($affinityprogram_unique_id, $affinityprogram_offer_id)
	{
		DB::table('affinity_programs_offers')
			->where('affinityprogramId', $affinityprogram_unique_id)
			->where('id', $affinityprogram_offer_id)
			->delete();

		return Redirect::route('admin-affinity-program')
			->with('globalalertmessage', 'Affinity Program Offer Deleted')
			->with('globalalertclass', 'success');
	}

}
