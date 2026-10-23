<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class BulksmsDriver extends AbstractDriver
{
    private string $baseUrl = 'https://bulksmsbd.net/api';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->get('/smsapi', [
                'api_key' => $this->config['api_key'],
                'senderid' => $this->config['sender_id'],
                'type' => 'text',
                'number' => implode(',', $this->recipients),
                'message' => $this->message,
            ])
            ->json();

        if (($response['response_code'] ?? 0) !== 202) {
            throw new SMSifyException($response['error_message'] ?? 'BulkSMS BD API error');
        }

        return new ResponseDTO(success: true, data: $response);
    }

    protected function validate(): void
    {
        if (empty($this->config['api_key'])) {
            throw new SMSifyException('Please set api_key for BulkSMS in config/smsify.php.');
        }
        if (empty($this->config['sender_id'])) {
            throw new SMSifyException('Please set sender_id for BulkSMS in config/smsify.php.');
        }
    }
}
