<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Release Configuration
    |--------------------------------------------------------------------------
    |
    | Configure which release channel and type to use when checking for updates.
    | Channel: 'latest' fetches the most recent stable version
    |          'next' fetches the next sequential version
    | Type: 'stable', 'beta', etc.
    |
    */
    'release' => [
        'channel' => env('UPDATEIFY_CHANNEL', 'next'),
        'type' => env('UPDATEIFY_TYPE', 'stable'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Paths
    |--------------------------------------------------------------------------
    |
    | Configure where temporary files are stored during the update process.
    | All paths are relative to Laravel's storage directory.
    |
    */
    'paths' => [
        'temp' => storage_path('updateify'),
        'download' => storage_path('updateify/downloads'),
        'extract' => storage_path('updateify/extracted'),
        'progress_file' => storage_path('updateify/.update-progress'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Protected Paths
    |--------------------------------------------------------------------------
    |
    | Files and directories listed here will never be modified during updates.
    | These paths are merged with any protected paths defined in the update
    | manifest (update.json), but manifest cannot remove these defaults.
    |
    */
    'protected' => [
        '.env',
        '.env.backup',
        '.git',
        '.htaccess',
        'public/.htaccess',
        'public/uploads',
        'storage',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sync Directories
    |--------------------------------------------------------------------------
    |
    | Directories listed here will be fully synchronized during updates.
    | This means existing contents are removed and replaced with update contents.
    | Additional directories can be added via the update manifest.
    |
    */
    'sync_directories' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Post-Update Actions
    |--------------------------------------------------------------------------
    |
    | Configure what actions to run after files have been installed.
    | These can be overridden by the update manifest.
    |
    */
    'post_update' => [
        'migrate' => true,
        'seed' => true,
        'clear_cache' => true,
        'commands' => [
            // 'config:cache',
            // 'route:cache',
            // 'view:cache',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | Configure caching for update checks to reduce API calls.
    | Set 'enabled' to false to always fetch fresh data.
    |
    */
    'cache' => [
        'enabled' => true,
        'key' => 'updateify.latest_release',
        'ttl' => 3600,
    ],

];
