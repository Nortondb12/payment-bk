<?php

declare(strict_types=1);

use App\Models\Brand;
use App\Services\Brand\Bootstrappers\BrandConfigBootstrapper;
use App\Services\Brand\Bootstrappers\ConfigBootstrapper;
use App\Services\Brand\Bootstrappers\TimezoneBootstrapper;
use App\Services\Brand\Bootstrappers\ViewBootstrapper;
use Filament\Actions\Imports\Jobs\ImportCsv;
use Illuminate\Broadcasting\BroadcastEvent;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Mail\SendQueuedMailable;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Queue\CallQueuedClosure;

return [
    /*
    |--------------------------------------------------------------------------
    | Brand & Domain Models
    |--------------------------------------------------------------------------
    */
    'models' => [
        'brand' => Brand::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */
    'queue' => [
        'brand_aware_by_default' => false,

        'queueable_to_job' => [
            SendQueuedMailable::class => 'mailable',
            SendQueuedNotifications::class => 'notification',
            CallQueuedClosure::class => 'closure',
            CallQueuedListener::class => 'class',
            BroadcastEvent::class => 'event',
        ],

        'brand_aware_jobs' => [
            ImportCsv::class,
        ],

        'not_brand_aware_jobs' => [
            //
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Bootstrappers
    |--------------------------------------------------------------------------
    |
    | The bootstrappers array lets you register classes that will be run when
    | a brand is initialized. These classes should implement the
    | BootstrapperInterface.
    */
    'bootstrappers' => [
        ConfigBootstrapper::class,
        BrandConfigBootstrapper::class,
        TimezoneBootstrapper::class,
        ViewBootstrapper::class,
    ],
];
