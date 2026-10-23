<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class SslDriver extends AbstractDriver
{
    private string $baseUrl = 'https://smsplus.sslwireless.com/api/v3';

    protected function execute(): ResponseDTO
    {
        $endpoint = count($this->recipients) > 1 ? '/send-sms/bulk' : '/send-sms';

        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->acceptJson()
            ->asJson()
            ->post($endpoint, [
                'api_token' => $this->config['api_token'],
                'sid' => $this->config['sender_id'],
                'msisdn' => implode(',', $this->recipients),
                'sms' => $this->message,
                'csms_id' => $this->config['csms_id'] ?? uniqid('smsify_'),
            ])
            ->json();

        if (($response['status'] ?? '') === 'FAILED' || isset($response['error'])) {
            throw new SMSifyException($response['error'] ?? $response['status_message'] ?? 'SSL Wireless API error');
        }

        return new ResponseDTO(
            success: ($response['status'] ?? '') === 'SUCCESS',
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['api_token'])) {
            throw new SMSifyException('Please set api_token for SSL Wireless in config/smsify.php.');
        }

        if (empty($this->config['sender_id'])) {
            throw new SMSifyException('Please set sender_id for SSL Wireless in config/smsify.php.');
        }
    }
}
