<?php

class PageController extends BaseController {

	/* Home Page (GET) */
	public function getHome()
	{	
		// START - Checklist For Left Menu
		// !DRY :( - Check alternative
		$user_id = Auth::id();
		$info_check = array();
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['basic'] = "True";	} else { $info_check['basic'] = "False"; }
		$home_info = DB::table('home_infos')->where('user_id', $user_id)->first();
		if(!is_null($home_info)) {	$info_check['home'] = "True";	} else { $info_check['home'] = "False"; }
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);		
		// END - Checklist For Left Menu

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
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);		
		// END - Checklist For Left Menu

		$user_id = Auth::id();

		$static_departments = DB::table('static_departments')->get();
		View::share('static_departments',$static_departments);
		
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(is_null($basic_info)) {
			$basic_info = new stdClass();
			$basic_info->firstname = "";
			$basic_info->middlename = "";
			$basic_info->lastname = "";
			$basic_info->projectguide = "";
			$basic_info->email = "";
			$basic_info->phone = "";
			$basic_info->department = "";
			$basic_info->optionsRadiosDegree = "";
			$basic_info->graduatingyear = "";
			$basic_info->optionsRadiosFuture = "";
			$basic_info->future_field1 = "";
			$basic_info->future_field2 = "";

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
				'projectguide'		=> 'required',
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
			$graduatingyear 		= Input::get('graduatingyear');
			$optionsRadiosFuture 	= Input::get('optionsRadiosFuture');

			if ($optionsRadiosFuture == 'Job') {
				$future_field1 		= Input::get('companyname');
				$future_field2 	= Input::get('companylocation');
			} elseif ($optionsRadiosFuture == 'Higher Studies') {
				$future_field1 		= Input::get('universityname');
				$future_field2 	= Input::get('universitydepartment');
			} elseif ($optionsRadiosFuture == 'Others') {
				$future_field1 		= Input::get('futureothers');
				$future_field2		= null;
			}

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
						'graduatingyear'		=> $graduatingyear,
						'optionsRadiosFuture'	=> $optionsRadiosFuture,
						'future_field1'			=> $future_field1,
						'future_field2'			=> $future_field2
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
					'graduatingyear'		=> $graduatingyear,
					'optionsRadiosFuture'	=> $optionsRadiosFuture,
					'future_field1'			=> $future_field1,
					'future_field2'			=> $future_field2
				));

				return Redirect::route('basic-info')
                    ->with('globalalertmessage', 'Basic Information Created')
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
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
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
                    	->with('globalalertmessage', 'Home Information Created')
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
                    	->with('globalalertmessage', 'Home Information Created')
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
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
		$socialmedia_info = DB::table('socialmedia_infos')->where('user_id', $user_id)->first();
		if(!is_null($socialmedia_info)) {	$info_check['socialmedia'] = "True";	} else { $info_check['socialmedia'] = "False"; }
		View::share('info_check',$info_check);		
		// END - Checklist For Left Menu

		return View::make('page.instilifeinfo');
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
		$basic_info = DB::table('basic_infos')->where('user_id', $user_id)->first();
		if(!is_null($basic_info)) {	$info_check['instilife'] = "True";	} else { $info_check['instilife'] = "False"; }
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

	/* Home Info Page (POST) */
	public function postSocialmediaInfo()
	{
		$validator = Validator::make(Input::all(),
			array(
				'googleplusprofilelink' => 'required',
				'linkedinprofilelink'	=> 'required',
				'facebookprofilelink'	=> 'required'				
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
                    ->with('globalalertmessage', 'Social Media Information Created')
                    ->with('globalalertclass', 'success');
			}

			return Redirect::route('home');

		}
	}

}
