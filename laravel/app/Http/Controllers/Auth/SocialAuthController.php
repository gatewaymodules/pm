<?php

namespace App\Http\Controllers\Auth;

use App\AuthenticateUser;
use App\AuthenticateUserListener;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialAuthController extends Controller implements
    AuthenticateUserListener
{
    /**
     * @param AuthenticateUser $authenticateUser
     * @param Request $request
     * @param null $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function login(AuthenticateUser $authenticateUser, Request $request, $provider = null)
    {
        //dd($provider);
        return $authenticateUser->execute($request->all(), $provider);
        //return $authenticateUser->execute($request->all(), $this, $provider);
        //$hasCode = $request->has('code');
        //return $authenticateUser->execute($hasCode, $this);
    }

    /**
     * When a user has successfully been logged in...
     *
     * @param $user
     * @return \Illuminate\Routing\Redirector
     */
    public function userHasLoggedIn($user)
    {
        return redirect('/project');
    }

}