<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class RobiDriver extends AbstractDriver
{
    private string $baseUrl = 'https://bmpws.robi.com.bd/ApacheGearWS';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->asForm()
            ->post('/SendTextMessage', [
                'username' => $this->config['username'],
                'password' => $this->config['password'],
                'To' => implode(',', $this->recipients),
                'Message' => $this->message,
            ]);

        $body = $response->body();

        if (str_contains(mb_strtolower($body), 'error') || str_contains(mb_strtolower($body), 'fail')) {
            throw new SMSifyException($body ?: 'Robi API error');
        }

        return new ResponseDTO(
            success: true,
            data: ['response' => $body],
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['username'])) {
            throw new SMSifyException('Please set username for Robi in config/smsify.php.');
        }

        if (empty($this->config['password'])) {
            throw new SMSifyException('Please set password for Robi in config/smsify.php.');
        }
    }
}
