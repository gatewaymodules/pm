<?php

namespace App\Repositories;

use App\User;

class UserRepositoryBackup {

    public function findByUsernameOrCreate($userData)
    {
        $user = User::where('email', '=', $userData->email)->first();
        if(!$user) {
            return User::firstOrCreate([
                //'name' => $userData->name,
                'email'=> $userData->email,
                //'avatar' => $userData->avatar,
                //'first_name' => $userData->user['first_name'],
                //'last_name' => $userData->user['last_name'],
                //'subscription_status' => '1',
            ]);
        }
        return $user;
//        return User::firstOrCreate([
//            'username'  =>  $userData->name,
//            'email' =>  $userData->email,
//        ]);

    }
}