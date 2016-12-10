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
		View::share('basic_info', $basic_info);

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
					'grad_year' 			=> $grad_year
				));

			return Redirect::route('yearbook-home')
				->with('globalalertmessage', 'Yearbook Entry Created')
				->with('globalalertclass', 'success');
		}



	}

}
