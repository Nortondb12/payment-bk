<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Server Side Rendering
    |--------------------------------------------------------------------------
    |
    | Themes are rendered client side only, so no SSR runtime has to be kept
    | alive alongside the application.
    */
    'ssr' => [
        'enabled' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    |
    | Page components are owned by themes rather than by the application, so
    | every theme contributes its own page directory.
    */
    'pages' => [
        'ensure_pages_exist' => false,

        'paths' => array_map(
            fn (string $directory): string => $directory.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'pages',
            glob(base_path('themes').DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR) ?: [],
        ),

        'extensions' => ['tsx', 'jsx', 'ts', 'js'],
    ],

    'testing' => [
        'ensure_pages_exist' => true,
    ],
];
