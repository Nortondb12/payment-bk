<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Notifications;

use Illuminate\Notifications\Notification;
use Revoltify\SMSify\Facades\SMSify;

class SMSifyChannel
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        if (! $to = $notifiable->routeNotificationFor('smsify', $notification)) {
            return;
        }

        /** @phpstan-ignore method.notFound */
        $message = $notification->toSMSify($notifiable);

        $driver = method_exists($notification, 'smsifyDriver')
            ? $notification->smsifyDriver()
            : null;

        SMSify::driver($driver)->to($to)->message($message->content)->send();
    }
}
