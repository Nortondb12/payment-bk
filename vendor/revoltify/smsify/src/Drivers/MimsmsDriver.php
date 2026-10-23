<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class MimsmsDriver extends AbstractDriver
{
    private string $baseUrl = 'https://api.mimsms.com/api/V2';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->asJson()
            ->post('/SMS', [
                'apiKey' => $this->config['api_key'],
                'userName' => $this->config['username'],
                'senderName' => $this->config['sender_id'],
                'transactionType' => 'T',
                'mobileNumber' => implode(',', $this->recipients),
                'message' => $this->message,
            ])
            ->json();

        if ((int) $response['statusCode'] !== 200) {
            throw new SMSifyException($response['responseResult']);
        }

        return new ResponseDTO(
            success: true,
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (! $this->config['username']) {
            throw new SMSifyException('Please set username for Mimsms in config/smsify.php.');
        }

        if (! $this->config['api_key']) {
            throw new SMSifyException('Please set api_key for Mimsms in config/smsify.php.');
        }

        if (! $this->config['sender_id']) {
            throw new SMSifyException('Please set sender_id for Mimsms in config/smsify.php.');
        }
    }
}
