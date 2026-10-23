<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class EsmsDriver extends AbstractDriver
{
    private string $baseUrl = 'https://login.esms.com.bd/api/v3';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->withToken($this->config['api_token'])
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->acceptJson()
            ->post('/sms/send', [
                'recipient' => implode(',', $this->recipients),
                'sender_id' => $this->config['sender_id'],
                'type' => 'plain',
                'message' => $this->message,
            ])
            ->json();

        if ($response['status'] === 'error') {
            throw new SMSifyException($response['message']);
        }

        return new ResponseDTO(
            success: $response['status'] === 'success',
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (! $this->config['sender_id']) {
            throw new SMSifyException('Please set sender_id for ESMS in config/smsify.php.');
        }

        if (! $this->config['api_token']) {
            throw new SMSifyException('Please set api_token for ESMS in config/smsify.php.');
        }
    }
}
