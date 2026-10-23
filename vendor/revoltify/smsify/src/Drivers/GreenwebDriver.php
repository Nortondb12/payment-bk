<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class GreenwebDriver extends AbstractDriver
{
    private string $baseUrl = 'https://api.greenweb.com.bd';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->acceptJson()
            ->get('/api.php', [
                'json' => '',
                'token' => $this->config['token'],
                'to' => implode(',', $this->recipients),
                'message' => $this->message,
            ])
            ->json();

        if (isset($response['error']) || (isset($response[0]) && str_contains($response[0], 'Error'))) {
            throw new SMSifyException($response['error'] ?? $response[0] ?? 'GreenWeb API error');
        }

        return new ResponseDTO(
            success: true,
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['token'])) {
            throw new SMSifyException('Please set token for GreenWeb in config/smsify.php.');
        }
    }
}
