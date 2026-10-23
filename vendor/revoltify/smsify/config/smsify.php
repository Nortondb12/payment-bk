<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    | This is the provider SMSify will use unless specified otherwise.
    */
    'default' => env('SMSIFY_DRIVER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | SMS Drivers Configuration
    |--------------------------------------------------------------------------
    | Add your credentials for the providers here.
    */
    'drivers' => [
        'esms' => [
            'api_token' => env('SMSIFY_ESMS_TOKEN'),
            'sender_id' => env('SMSIFY_ESMS_SENDER_ID'),
        ],
        'mimsms' => [
            'username' => env('SMSIFY_MIMSMS_USERNAME'),
            'api_key' => env('SMSIFY_MIMSMS_API_KEY'),
            'sender_id' => env('SMSIFY_MIMSMS_SENDER_ID'),
        ],
        'ssl' => [
            'api_token' => env('SMSIFY_SSL_TOKEN'),
            'sender_id' => env('SMSIFY_SSL_SENDER_ID'),
            'csms_id' => env('SMSIFY_SSL_CSMS_ID'),
        ],
        'grameenphone' => [
            'username' => env('SMSIFY_GP_USERNAME'),
            'password' => env('SMSIFY_GP_PASSWORD'),
            'cli' => env('SMSIFY_GP_CLI', '2222'),
            'message_type' => env('SMSIFY_GP_MESSAGE_TYPE', 1),
        ],
        'banglalink' => [
            'user_id' => env('SMSIFY_BL_USER_ID'),
            'password' => env('SMSIFY_BL_PASSWORD'),
            'sender_id' => env('SMSIFY_BL_SENDER_ID'),
        ],
        'robi' => [
            'username' => env('SMSIFY_ROBI_USERNAME'),
            'password' => env('SMSIFY_ROBI_PASSWORD'),
        ],
        'infobip' => [
            'base_url' => env('SMSIFY_INFOBIP_BASE_URL'),
            'username' => env('SMSIFY_INFOBIP_USERNAME'),
            'password' => env('SMSIFY_INFOBIP_PASSWORD'),
            'sender_id' => env('SMSIFY_INFOBIP_SENDER_ID'),
        ],
        'adnsms' => [
            'api_key' => env('SMSIFY_ADNSMS_API_KEY'),
            'api_secret' => env('SMSIFY_ADNSMS_API_SECRET'),
            'sender_id' => env('SMSIFY_ADNSMS_SENDER_ID'),
            'request_type' => env('SMSIFY_ADNSMS_REQUEST_TYPE', 'SINGLE_SMS'),
            'message_type' => env('SMSIFY_ADNSMS_MESSAGE_TYPE', 'TEXT'),
        ],
        'alphasms' => [
            'api_key' => env('SMSIFY_ALPHASMS_API_KEY'),
            'sender_id' => env('SMSIFY_ALPHASMS_SENDER_ID'),
        ],
        'greenweb' => [
            'token' => env('SMSIFY_GREENWEB_TOKEN'),
        ],
        'bulksms' => [
            'api_key' => env('SMSIFY_BULKSMS_API_KEY'),
            'sender_id' => env('SMSIFY_BULKSMS_SENDER_ID'),
        ],
        'elitbuzz' => [
            'url' => env('SMSIFY_ELITBUZZ_URL'),
            'api_key' => env('SMSIFY_ELITBUZZ_API_KEY'),
            'sender_id' => env('SMSIFY_ELITBUZZ_SENDER_ID'),
            'type' => env('SMSIFY_ELITBUZZ_TYPE', 'text'),
        ],
        'smsnoc' => [
            'api_token' => env('SMSIFY_SMSNOC_TOKEN'),
            'sender_id' => env('SMSIFY_SMSNOC_SENDER_ID'),
        ],
        'smsq' => [
            'sender_id' => env('SMSIFY_SMSQ_SENDER_ID'),
            'api_key' => env('SMSIFY_SMSQ_API_KEY'),
            'client_id' => env('SMSIFY_SMSQ_CLIENT_ID'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP Request Configuration
    |--------------------------------------------------------------------------
    | Set the timeout, retry, and retry delay for the HTTP client.
    */
    'request' => [
        'timeout' => env('SMSIFY_REQUEST_TIMEOUT', 10),
        'retry' => env('SMSIFY_REQUEST_RETRY', 3),
        'retry_delay' => env('SMSIFY_REQUEST_RETRY_DELAY', 300),
    ],
];
