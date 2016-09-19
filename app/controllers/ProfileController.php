<?php

class ProfileController extends BaseController {

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

    /* Viewing the Profile */
	public function getProfileUserId($user_id) {
        // return $user_id;
        $user = DB::table('users')->where('rollno', $user_id)->first();
		if(!is_null($user)) {
			// return dd($user);
            $basic_info = DB::table('basic_infos')->where('user_id', $user->id)->first();
            return dd($basic_info);

		} else {
			return "User Not Found";
		}
		// return View::make('account.signin');
	}

}
