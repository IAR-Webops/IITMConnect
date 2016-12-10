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

    /* Viewing the Yearbook */
	public function getYearbookUserId($user_id) {
        // return $user_id;
        $user = DB::table('users')->where('rollno', $user_id)->first();
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
    public function getYearbookUserIdEdit($user_id)
    {
        $user = DB::table('users')->where('rollno', $user_id)->first();
		if(!is_null($user)) {
			// return dd($user);
            $basic_info = DB::table('basic_infos')->where('user_id', $user->id)->first();
            // return dd($basic_info);
            View::share('basic_info', $basic_info);
            return View::make('yearbook.yearbook_user_edit');

		} else {
			return "User Not Found";
		}
    }

}
