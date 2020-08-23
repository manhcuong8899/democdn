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

    'facebook' => [
            'client_id' => '368257153624802',
            'client_secret' => '1802fd6f7da4e827e4ff527a074ea541',
            'redirect' => 'https://scd1688.com/login/facebook/callback',
    ],
    'google' => [
            'client_id' => '95955022807-cifa8t6rmk19u58rqto9nnb3ggmu7cea.apps.googleusercontent.com',
            'client_secret' => 'Qwot0-vz_YAiEGNo6yCht3AO',
            'redirect' => 'https://scd1688.com/login/google/callback',
    ],

];
