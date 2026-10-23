<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class SmsqDriver extends AbstractDriver
{
    private string $baseUrl = 'https://api.smsq.global/api/v2';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->acceptJson()
            ->post('/SendSMS', [
                'senderId' => $this->config['sender_id'],
                'is_Unicode' => false,
                'apiKey' => $this->config['api_key'],
                'clientId' => $this->config['client_id'],
                'mobileNumbers' => implode(',', $this->recipients),
                'message' => $this->message,
            ])
            ->json();

        if (isset($response['ErrorCode']) && $response['ErrorCode'] !== 0) {
            throw new SMSifyException($response['ErrorDescription']);
        }

        return new ResponseDTO(
            success: true,
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (! $this->config['sender_id']) {
            throw new SMSifyException('Please set sender_id for smsnoc in config/smsify.php.');
        }

        if (! $this->config['api_key']) {
            throw new SMSifyException('Please set api_key for smsq in config/smsify.php.');
        }

        if (! $this->config['client_id']) {
            throw new SMSifyException('Please set client_id for smsq in config/smsify.php.');
        }
    }
}
