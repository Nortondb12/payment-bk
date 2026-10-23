<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class AlphasmsDriver extends AbstractDriver
{
    private string $baseUrl = 'https://api.sms.net.bd';

    protected function execute(): ResponseDTO
    {
        $params = [
            'api_key' => $this->config['api_key'],
            'msg' => $this->message,
            'to' => implode(',', $this->recipients),
        ];

        if (! empty($this->config['sender_id'])) {
            $params['sender_id'] = $this->config['sender_id'];
        }

        if (! empty($this->config['schedule'])) {
            $params['schedule'] = $this->config['schedule'];
        }

        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->acceptJson()
            ->post('/sendsms', $params)
            ->json();

        if (($response['error'] ?? 0) !== 0) {
            throw new SMSifyException($response['msg'] ?? 'Alpha SMS API error');
        }

        return new ResponseDTO(
            success: ($response['error'] ?? 1) === 0,
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['api_key'])) {
            throw new SMSifyException('Please set api_key for Alpha in config/smsify.php.');
        }
    }
}
