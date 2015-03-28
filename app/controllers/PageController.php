<?php

class PageController extends BaseController {

	/* Home Page (GET) */
	public function getHome()
	{
		return View::make('page.home');
	}

	

}
