<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class BanglalinkDriver extends AbstractDriver
{
    private string $baseUrl = 'https://vas.banglalink.net/sendSMS';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->asForm()
            ->post('/sendSMS', [
                'userID' => $this->config['user_id'],
                'passwd' => $this->config['password'],
                'sender' => $this->config['sender_id'],
                'msisdn' => implode(',', $this->recipients),
                'message' => $this->message,
            ]);

        $body = $response->body();

        // Banglalink returns XML/text response
        if (str_contains(mb_strtolower($body), 'error') || str_contains(mb_strtolower($body), 'fail')) {
            throw new SMSifyException($body ?: 'Banglalink API error');
        }

        return new ResponseDTO(
            success: true,
            data: ['response' => $body],
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['user_id'])) {
            throw new SMSifyException('Please set user_id for Banglalink in config/smsify.php.');
        }

        if (empty($this->config['password'])) {
            throw new SMSifyException('Please set password for Banglalink in config/smsify.php.');
        }

        if (empty($this->config['sender_id'])) {
            throw new SMSifyException('Please set sender_id for Banglalink in config/smsify.php.');
        }
    }
}
