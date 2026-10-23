<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Log;
use Revoltify\SMSify\DTOs\ResponseDTO;

class LogDriver extends AbstractDriver
{
    protected function execute(): ResponseDTO
    {
        Log::info('[SMSify] Message sent', [
            'recipients' => $this->recipients,
            'message' => $this->message,
        ]);

        return new ResponseDTO(
            success: true,
            data: [
                'message' => 'Message sent successfully',
            ],
        );
    }
}
