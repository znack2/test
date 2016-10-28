<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Default URL Shortening provider
    |--------------------------------------------------------------------------
    |
    | Supported Providers: bitly
    |
    */
    'default' => 'bitly',
    /*
    |--------------------------------------------------------------------------
    | URL Shortening Providers
    |--------------------------------------------------------------------------
    |
    | Here are each of the URL Shortening Providers configuration.
    |
    */
    'drivers' => [
        'bitly' => [
            'domain' => 'https://api-ssl.bitly.com',
            'endpoint' => '/v3/shorten',
            'token' => 'YOUR-TOKEN-HERE',
        ],
        'google' => [
                    'domain' => 'https://api-ssl.bitly.com',
                    'endpoint' => '/v3/shorten',
                    'token' => 'YOUR-TOKEN-HERE',
        ],
    ],
];