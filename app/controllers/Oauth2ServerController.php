<?php

class Oauth2ServerController extends BaseController {

	/**
	 * Display approve / Deny Page
	 *
	 */
	public function getAuthCodeForm()
	{
		//
		//return "Test";
	    // get the data from the check-authorization-params filter

		$authParams = Authorizer::getAuthCodeRequestParams();
		//return $authParams;

	    //$params = Session::get('authorize-params');
	    // get the user id
	    $params['user_id'] = Auth::user()->id;
	    $params['client_id'] = $authParams['client']->getId();
	    $params['redirect_uri'] = $authParams['redirect_uri'];
	    $params['response_type'] = $authParams['response_type'];
	    //return $params;

	    // display the authorization form
	    return View::make('oauth.authorization-form', array('params' => $params));
	}

	public function postAuthCodeForm(){
		// get the data from the check-authorization-params filter
	    // $params = Session::get('authorize-params');

	    //return Input::all();

		$authParams = Authorizer::getAuthCodeRequestParams();
		$params['client_id'] = $authParams['client']->getId();
	    $params['redirect_uri'] = $authParams['redirect_uri'];    

	    // get the user id
	    $params['user_id'] = Auth::user()->id;
	    $redirectUri = '';

	    // return $params;

	    // check if the user approved or denied the authorization request
	    if (Input::get('approve') !== null) {

	        // $code = Authorizer::newAuthorizeRequest('user', $params['user_id'], $params);

	        // Session::forget('authorize-params');

	        // return Redirect::to(AuthorizationServer::makeRedirectWithCode($code, $params));

	        $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
	    }

	    if (Input::get('deny') !== null) {

	        // Session::forget('authorize-params');

	        // return Redirect::to(AuthorizationServer::makeRedirectWithError($params));
	    	$redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();

	    }
	    return Redirect::to($redirectUri);

	}

	public function postAccessToken(){
	    // return AuthorizationServer::performAccessTokenFlow();
	    $accessTokenResponse = Authorizer::issueAccessToken();
	    $accessTokenResponseString = json_encode($accessTokenResponse);
		$accessTokenResponseJSON = json_decode($accessTokenResponseString);
		// return gettype($accessTokenResponseJSON);
		// return $accessTokenResponseJSON->access_token;

	    $oauth_access_token = DB::table('oauth_access_tokens')->where('id', $accessTokenResponseJSON->access_token)->first();
	    if ($oauth_access_token->count()) {
			

			return $oauth_access_token;	   
			

	    } else {
		    return $accessTokenResponse;
	    }

	}
	


}
