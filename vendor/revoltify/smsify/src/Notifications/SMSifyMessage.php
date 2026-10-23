<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Notifications;

final readonly class SMSifyMessage
{
    /**
     * Create a new message instance.
     */
    public function __construct(public string $content = '') {}
}
