<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData, $provider)
    {
//        if (!isset($userData->email)) {
//            $userData->email = time() . '-no-reply@easyauthenticator.com';
//        }
        $user = User::where('provider_id', '=', $userData->id)->first();
        $emailExists = User::where('email', '=', $userData->email)->first();
        if (!$user && $emailExists) {
            return false;
        }
        if (!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'provider' => $provider,
                'name' => $userData->name,
                'username' => $userData->nickname,
                'email' => $userData->email,
                'avatar' => $userData->avatar,
            ]);
        }
        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'name' => $userData->name,
            'username' => $userData->nickname,
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'name' => $user->name,
            'username' => $user->username,
        ];
        if (!empty(array_diff($socialData, $dbData))) {
            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->name = $userData->name;
            $user->username = $userData->nickname;
            $user->save();
        }
    }
}