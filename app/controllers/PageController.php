<?php

class PageController extends BaseController {

	/* Home Page (GET) */
	public function getHome()
	{

		return View::make('page.homebody');
	}

	/* Basic Info Page (GET) */
	public function getBasicInfo()
	{
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

	/* Basic Info Page (GET) */
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
						
				return "Updated Existing Entry";

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

				return "Creating new entry";
			}


			

			return "Saved";

		}
		
	}

	/* Home Info Page (GET) */
	public function getHomeInfo()
	{
		return View::make('page.homeinfo');
	}

	/* Insti Life Info Page (GET) */
	public function getInstiLifeInfo()
	{
		return View::make('page.instilifeinfo');
	}

	/* Social Media Info Page (GET) */
	public function getSocialMediaInfo()
	{
		return View::make('page.socialmediainfo');
	}

}
