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
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY', 'pk_test_51JNvepLs7mDJOC9wI5vonC8ra8gA9e5skIXWrX8dzszp7xFTOdBhuv9vzJbp4KU1O1E3ldswjRaJ5hnnjwwXgGSR00BrzbJexX'),
        'secret' => env('STRIPE_SECRET', 'sk_test_51JNvepLs7mDJOC9w5RCbteamIH4NCDsufdllAVKWYATUdl5z4dLAhS9EDYsFnFP77T0Z4Fr4d0FkC8uaWgmjKmze00C2tnhKx6'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'paypal' => [
        'client_id'   	=> env('PAYPAL_CLIENT_ID',  	'AZTjUbjfLIoqdOtRYbVLFiryYGjdEd9Zn0Nf0nL3lGN7k-KIOogqwvNBfwafJbdz8zHz3UI24h_7nTnS'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', 	'EGCFaCBHPAA0n8acqTROPyBWeVl9P7gHchxI4NqCjkPgr-4UBkdcNkmqUOMOGJr9CyHusawNwUgYgFS-'),
        'mail'          => 'crystal_collector@gmail.com'
    ],

    'google_map_api' => [
        'key' => 'AIzaSyAyQ0R_fqunvWIZeJUAH_NrbOp6012hS44',
        'libraries' => 'places',
        'region' => 'DE',
        'language' => 'de',
    ]

];
