<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'google' => [
        'client_id' => '768348812743-phvgvfnulkeuo4ppupalprgi6kg2ivkt.apps.googleusercontent.com',
        'client_secret' => 'JMbiN45uCRC2vKkF7wMdc21n',
        'redirect' => 'http://pm.snowball.co.za/login/google',
    ],

    'facebook' => [
        'client_id' => '842996059083385',
        'client_secret' => '2167c934400d6bcd889ae0381cfcbea1',
        'redirect' => 'http://pm.snowball.co.za/login/facebook',
    ],

    'github' => [
        'client_id' => '6b395ace151665393bb4',
        'client_secret' => '882c2fa69d9ce8725ee1f971de02df3581475a3a',
        'redirect' => 'http://pm.snowball.co.za/login/github',
    ],

    'twitter' => [
        'client_id' => 'UeFmpUQneQsjjU6awDki4Btbe',
        'client_secret' => 'wzerSaRLOAf0ca3kovEnyfJAMDC4d1GMaciiDwuWRBpzmPgGg0',
        'redirect' => 'http://pm.snowball.co.za/login/twitter',
    ],

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key' => '',
        'secret' => '',
    ],

];
