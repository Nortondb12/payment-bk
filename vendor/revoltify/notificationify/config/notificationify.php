<?php

declare(strict_types=1);

use Revoltify\Notificationify\Models\NotificationChannel;

return [
    /*
    |--------------------------------------------------------------------------
    | Notification Channel Model
    |--------------------------------------------------------------------------
    |
    | The model to use for notification channels. You can customize this
    | to use your own model that extends the base NotificationChannel.
    |
    */
    'model' => NotificationChannel::class,
];
