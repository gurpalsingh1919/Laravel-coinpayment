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

     'facebook' => [ 
                'client_id' => '163824907772716',
                'client_secret' =>'00ac530696209357a50525d43e29ea39',
                'redirect' => 'http://kwatt.dsss.in/callback/facebook'
        ],
      
        'twitter' => [ 
                
                'client_id' => 'iVYo4F7WOHYaC4PFSlgkq9oKH',
                'client_secret' => 'A8AivCCu9aq3NH9o39tKRdYXOKsW3WeRSG2rJzxmfWyEnRaTkn',
                'redirect' =>  'http://kwatt.dsss.in/callback/twitter' 
        ],
       

];
