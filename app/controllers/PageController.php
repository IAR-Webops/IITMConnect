<?php

class PageController extends BaseController {

	/* Home Page (GET) */
	public function getHome()
	{
		return View::make('page.home');
	}

	/* Basic Info Page (GET) */
	public function getBasicInfo()
	{
		return View::make('page.basicinfo');
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
