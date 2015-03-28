<?php

class AccountController extends BaseController {

	
	### Sign In
	/* Viewing the form */
	public function getSignIn() {
		return View::make('account.signin');
	}
	
	
}  