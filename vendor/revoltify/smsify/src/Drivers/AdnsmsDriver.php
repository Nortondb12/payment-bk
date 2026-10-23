<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class AdnsmsDriver extends AbstractDriver
{
    private string $baseUrl = 'https://portal.adnsms.com/api/v1/secure';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay, throw: false)
            ->acceptJson()
            ->asForm()
            ->post('/send-sms', [
                'api_key' => $this->config['api_key'],
                'api_secret' => $this->config['api_secret'],
                'request_type' => $this->config['request_type'] ?? 'SINGLE_SMS',
                'message_type' => $this->config['message_type'] ?? 'TEXT',
                'senderid' => $this->config['sender_id'] ?? null,
                'mobile' => implode(',', $this->recipients),
                'message_body' => $this->message,
            ])
            ->json();

        if (($response['api_response_code'] ?? 0) !== 200) {
            throw new SMSifyException($response['api_response_message'] ?? 'ADN SMS API error');
        }

        return new ResponseDTO(
            success: true,
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['api_key'])) {
            throw new SMSifyException('Please set api_key for ADN in config/smsify.php.');
        }

        if (empty($this->config['api_secret'])) {
            throw new SMSifyException('Please set api_secret for ADN in config/smsify.php.');
        }
    }
}
