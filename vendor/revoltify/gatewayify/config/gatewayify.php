<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Provider Locations
    |--------------------------------------------------------------------------
    |
    | Where Gatewayify discovers your own payment providers. Each entry maps a
    | path (relative to the application base path) to its namespace. A provider
    | lives at "{path}/{Directory}/ProcessPayment.php" and overrides a bundled
    | provider sharing the same directory name.
    |
    */

    'providers' => [
        'app/Modules/Gateways' => 'App\\Modules\\Gateways',
    ],

    /*
    |--------------------------------------------------------------------------
    | Outbound HTTP
    |--------------------------------------------------------------------------
    |
    | Timeouts applied to every outbound gateway API call, in seconds. Retries
    | only cover failures raised before the request leaves your server, such
    | as an unreachable proxy, so a payment is never submitted twice.
    |
    | Set "retry.times" to 1 to disable retries. "retry.sleep" is milliseconds.
    |
    */

    'http' => [

        'timeout' => (int) env('GATEWAYIFY_HTTP_TIMEOUT', 30),

        'connect_timeout' => (int) env('GATEWAYIFY_HTTP_CONNECT_TIMEOUT', 10),

        'retry' => [
            'times' => (int) env('GATEWAYIFY_HTTP_RETRY_TIMES', 2),
            'sleep' => (int) env('GATEWAYIFY_HTTP_RETRY_SLEEP', 200),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Outbound Proxy
    |--------------------------------------------------------------------------
    |
    | Here you may configure the proxies used for outbound gateway API calls.
    | Each connection is keyed by gateway group, so a gateway whose upstream
    | restricts traffic by IP or region can route through its own proxy.
    |
    | Connections left blank are sent directly, so a fresh installation runs
    | without any proxy at all. A gateway running in sandbox mode is always
    | sent directly.
    |
    | Supported schemes: http, https, socks4, socks4a, socks5, socks5h.
    |
    | A connection is either a URL string or an array supporting per scheme
    | and per connection overrides:
    |
    |   'stripe' => [
    |       'url' => ['https' => 'http://user:pass@host:8080'],
    |       'timeout' => 60,
    |       'connect_timeout' => 15,
    |   ],
    |
    */

    'proxy' => [

        'connections' => [
            'bkash' => (string) env('GATEWAYIFY_PROXY_BKASH', ''),
            'cryptomus' => (string) env('GATEWAYIFY_PROXY_CRYPTOMUS', ''),
            'eps' => (string) env('GATEWAYIFY_PROXY_EPS', ''),
            'nagad' => (string) env('GATEWAYIFY_PROXY_NAGAD', ''),
            'paddle' => (string) env('GATEWAYIFY_PROXY_PADDLE', ''),
            'paypal' => (string) env('GATEWAYIFY_PROXY_PAYPAL', ''),
            'paystation' => (string) env('GATEWAYIFY_PROXY_PAYSTATION', ''),
            'sslcommerz' => (string) env('GATEWAYIFY_PROXY_SSLCOMMERZ', ''),
            'stripe' => (string) env('GATEWAYIFY_PROXY_STRIPE', ''),
            'upay' => (string) env('GATEWAYIFY_PROXY_UPAY', ''),
            'binance' => (string) env('GATEWAYIFY_PROXY_BINANCE', ''),
        ],

    ],

];
