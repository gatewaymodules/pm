<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;
use Request;

class AuthenticateUser
{

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users)
    {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    public function execute($request = null, $provider) {

        if (!$request) return $this->getAuthorizationFirst($provider);

        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider), $provider);
        if(!$user) {
            return redirect('/')->with('message', 'Email is already in use');
        }

        $this->auth->login($user, true);

        return $this->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider)
    {
        //dd($provider);
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }

    public function userHasLoggedIn($user) {
        return redirect('project/');
    }

}