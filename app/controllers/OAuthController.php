<?php

use Illuminate\Routing\Controller;
use LucaDegasperi\OAuth2Server\Authorizer;

class OAuthController extends Controller
{
    protected $authorizer;

    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;

        $this->beforeFilter('auth', ['only' => ['getAuthorize', 'postAuthorize']]);
        $this->beforeFilter('csrf', ['only' => 'postAuthorize']);
        //$this->beforeFilter('check-authorization-params', ['only' => ['getAuthorize', 'postAuthorize']]);
        $this->beforeFilter('check-authorization-params', ['only' => ['postAuthorize']]);
    }

    public function postAccessToken()
    {
         return Response::json($this->authorizer->issueAccessToken());
    }

    public function getAuthorize()
    {
        //return "test";

        $authParams = Authorizer::getAuthCodeRequestParams();
        $formParams = array_except($authParams,'client');
        $formParams['client_id'] = $authParams['client']->getId();

        return View::make('oauth.authorization-form', ['params'=>$formParams,'client'=>$authParams['client']]);
    }

    public function postAuthorize()
    {
        // get the user id
        $params['user_id'] = Auth::user()->id;

        $redirectUri = '';

        if (Input::get('approve') !== null) {
            $redirectUri = $this->authorizer->issueAuthCode('user', $params['user_id'], $params);
        }

        if (Input::get('deny') !== null) {
            $redirectUri = $this->authorizer->authCodeRequestDeniedRedirectUri();
        }

        return Redirect::to($redirectUri);
    }
}
