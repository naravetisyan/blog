<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'google' => [
        'client_id' => '598401737907-7m2e42eij8ajfv8uuij9gq43rbjm5uqf.apps.googleusercontent.com',
        'client_secret' => '3MWfJMr9KsKcT5s5M3Ryhr1b',
        'redirect' => 'http://blog.dev/login/google/callback',
    ],
    'facebook' => [
        'client_id' => '122818845074651',
        'client_secret' => '631ddd974aeb44191702d9c478e0e0ef',
        'redirect' => 'http://blog.dev/login/facebook/callback',
    ]

];
