<?php

class YearbookController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	/* View Yearbook Home */
	public function getYearbookHome()
	{
		$basic_info = DB::table('basic_infos')->where('user_id', Auth::id() )->first();
		// return dd($basic_info);
		// Concluding Basic Infos has been filled if Graduating Year entry exists in DB for that user
		if(!empty($basic_info->graduatingyear)) {	$basic_info_check = "True";	} else { $basic_info_check = "False"; }
		View::share('basic_info_check', $basic_info_check);

		View::share('basic_info', $basic_info);
		// dd($basic_info);

		$user_yearbook = DB::table('yearbook')->where('user_id', Auth::id() )->first();
		View::share('user_yearbook', $user_yearbook);

		if(empty($user_yearbook->insti_life_icons)){
			// Do Nothing
		} else {
			// Convert to Array
			$yearbook_icons_array = explode(",",$user_yearbook->insti_life_icons);
			// dd($yearbook_icons_array);
			View::share('yearbook_icons_array', $yearbook_icons_array);
		}


		return View::make('yearbook.home');
	}

    /* Viewing the User Yearbook */
	public function getYearbookRollNo($rollno) {
        // return $user_id;
        $user = DB::table('users')->where('rollno', $rollno)->first();
		if(!is_null($user)) {
			// return dd($user);
            $basic_info = DB::table('basic_infos')->where('user_id', $user->id)->first();
            // return dd($basic_info);
            View::share('basic_info', $basic_info);
            return View::make('yearbook.yearbook_user');

		} else {
			return "User Not Found";
		}
		// return View::make('account.signin');
	}

    /* Viewing the Yearbook Edit form */
    public function getYearbookRollNoEdit($rollno)
    {
		// START - Check if user is editing his own data
		$auth_rollno = Auth::user()->rollno;
		if( strcasecmp($auth_rollno, $rollno) == 0){
			// Do Nothing
		} else {
			return Redirect::to('/yearbook/'.$auth_rollno.'/edit')
				->with('globalalertmessage', 'Sorry, you can edit only your Yearbook data.')
				->with('globalalertclass', 'error');
		}
		// END - Check if user is editing his own data

        $user = DB::table('users')->where('rollno', $rollno)->first();
		if(!is_null($user)) {
			// return dd($user);
            $basic_info = DB::table('basic_infos')->where('user_id', $user->id)->first();
            // return dd($basic_info);
			View::share('basic_info', $basic_info);
            View::share('rollno', $rollno);

			$user_yearbook = DB::table('yearbook')->where('user_id', $user->id)->first();
			if(is_null($user_yearbook)) {
				$user_yearbook = new stdClass();
				$user_yearbook->insti_remember_for = "";
				$user_yearbook->insti_name = "";
				$user_yearbook->insti_craziest_moment = "";
			}
			View::share('user_yearbook', $user_yearbook);

            return View::make('yearbook.yearbook_user_edit');

		} else {
			return "User Not Found";
		}
    }

	public function postYearbookRollNoEdit($rollno)
	{
		// START - Check if user is editing his own data
		$auth_rollno = Auth::user()->rollno;
		if( strcasecmp($auth_rollno, $rollno) == 0){
			// Do Nothing
		} else {
			return "Nice try. But you shall not pass @yashmurty";
		}
		// END - Check if user is editing his own data

		$user_id = Auth::id();

		// return Input::all();
		$insti_remember_for 	= Input::get('insti_remember_for');
		$insti_name 			= Input::get('insti_name');
		$insti_craziest_moment 	= Input::get('insti_craziest_moment');
		$grad_year			 	= Input::get('grad_year');

		$user_yearbook = DB::table('yearbook')
							->where('user_id', $user_id)
							->first();

		if(!is_null($user_yearbook)) {

			DB::table('yearbook')
				->where('user_id', $user_id)
				->update(array(
					'insti_remember_for' 	=> $insti_remember_for,
					'insti_name'			=> $insti_name,
					'insti_craziest_moment'	=> $insti_craziest_moment,
					'grad_year'				=> $grad_year
				));

			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Yearbook Entry Updated')
				->with('globalalertclass', 'success');

		} else {

			DB::table('yearbook')
				->insert(array(
					'user_id'				=> $user_id,
					'insti_remember_for' 	=> $insti_remember_for,
					'insti_name'			=> $insti_name,
					'insti_craziest_moment'	=> $insti_craziest_moment,
					'grad_year' 			=> $grad_year,
					'order_status'			=> "null"
				));

			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Yearbook Entry Created')
				->with('globalalertclass', 'success');
		}

	}

	public function postYearbookRollNoIconsEdit($rollno)
	{
		// START - Check if user is editing his own data
		$auth_rollno = Auth::user()->rollno;
		if( strcasecmp($auth_rollno, $rollno) == 0){
			// Do Nothing
		} else {
			return "Nice try. But you shall not pass @yashmurty";
		}
		// END - Check if user is editing his own data

		$user_id = Auth::id();

		// return Input::all();
		$yearbook_icons 	= Input::get('yearbook_icons');
		if(sizeof($yearbook_icons) == 3){
			$yearbook_icons_string = implode(",",$yearbook_icons);
			// dd($yearbook_icons_string);

			$user_yearbook = DB::table('yearbook')
								->where('user_id', $user_id)
								->first();

			if(!is_null($user_yearbook)) {

				DB::table('yearbook')
					->where('user_id', $user_id)
					->update(array(
						'insti_life_icons' 	=> $yearbook_icons_string
					));

				return Redirect::route('yearbook-home')
					->with('globalalertmessage', 'Yearbook Icons Updated')
					->with('globalalertclass', 'success');

			} else {

				return Redirect::route('yearbook-home')
					->with('globalalertmessage', 'Failed. Please create Yearbook Entry first.')
					->with('globalalertclass', 'error');
			}

		} else {
			# code...
			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Failed. Looks like you did not select Three icons.')
				->with('globalalertclass', 'error');
		}


	}

	public function postYearbookRollNoOrderStatusEdit($rollno)
	{
		// START - Check if user is editing his own data
		$auth_rollno = Auth::user()->rollno;
		if( strcasecmp($auth_rollno, $rollno) == 0){
			// Do Nothing
		} else {
			return "Nice try. But you shall not pass @yashmurty";
		}
		// END - Check if user is editing his own data

		$user_id = Auth::id();

		// return Input::all();
		$order_status_value	= Input::get('order_status_value');

		$user_yearbook = DB::table('yearbook')
							->where('user_id', $user_id)
							->first();

		if(!is_null($user_yearbook)) {

			DB::table('yearbook')
				->where('user_id', $user_id)
				->update(array(
					'order_status' 	=> $order_status_value
				));

			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Yearbook Order Updated')
				->with('globalalertclass', 'success');

		} else {

			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Failed. Please create Yearbook Entry first.')
				->with('globalalertclass', 'error');
		}
	}

	public function getYearbookRollNoEditInstiStory($rollno)
	{
		// START - Check if user is editing his own data
		$auth_rollno = Auth::user()->rollno;
		if( strcasecmp($auth_rollno, $rollno) == 0){
			// Do Nothing
		} else {
			return Redirect::to('/yearbook/'.$auth_rollno.'/edit-insti-story')
				->with('globalalertmessage', 'Sorry, you can edit only your Yearbook data.')
				->with('globalalertclass', 'error');
		}
		// END - Check if user is editing his own data

		$user = DB::table('users')->where('rollno', $rollno)->first();
		if(!is_null($user)) {
			// return dd($user);
            $basic_info = DB::table('basic_infos')->where('user_id', $user->id)->first();
            // return dd($basic_info);
			View::share('basic_info', $basic_info);
            View::share('rollno', $rollno);

			$user_yearbook = DB::table('yearbook')->where('user_id', $user->id)->first();
			if(is_null($user_yearbook)) {
				return Redirect::to('/yearbook/')
					->with('globalalertmessage', 'Sorry, you need to create Yearbook Entry first.')
					->with('globalalertclass', 'error');
			}
			View::share('user_yearbook', $user_yearbook);

            return View::make('yearbook.yearbook_user_edit_insti_story');

		} else {
			return "User Not Found";
		}
	}

	public function postYearbookRollNoEditInstiStory($rollno)
	{
		// START - Check if user is editing his own data
		$auth_rollno = Auth::user()->rollno;
		if( strcasecmp($auth_rollno, $rollno) == 0){
			// Do Nothing
		} else {
			return "Nice try. But you shall not pass @yashmurty";
		}
		// END - Check if user is editing his own data

		$user_id = Auth::id();

		// return Input::all();
		$insti_story	= Input::get('insti_story');

		$user_yearbook = DB::table('yearbook')
							->where('user_id', $user_id)
							->first();

		if(!is_null($user_yearbook)) {

			DB::table('yearbook')
				->where('user_id', $user_id)
				->update(array(
					'insti_story' 	=> $insti_story
				));

			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Yearbook Insti Story Updated')
				->with('globalalertclass', 'success');

		} else {

			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Failed. Please create Yearbook Entry first.')
				->with('globalalertclass', 'error');
		}

	}

}
