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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\Modules\User\Models\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '317925341664924',
        'client_secret' => '0f71fcc13a4898893b5e294eb925d06d',
        'redirect' => 'http://empsuite.dev:8080/user/social/facebook/callback',
    ],
    'google' => [
        'client_id' => '233240797660-4etn4kk0uicigpntidfl0eaivte3bamq.apps.googleusercontent.com',
        'client_secret' => 'lKYoein5MTz82rn-1Hl9t0MT',
        'redirect' => 'http://empsuite.dev:8080/user/social/google/callback',
    ],
    'github' => [
            'client_id' => '6b6ca4002f4231da9e17',
            'client_secret' => '7a76e92d0cde7f7956358f0ad482498dbf3659ec',
            'redirect' => 'http://empsuite.dev:8080/user/social/github/callback',
    ]
];
