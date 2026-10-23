<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class InfobipDriver extends AbstractDriver
{
    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->config['base_url'])
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->withBasicAuth($this->config['username'], $this->config['password'])
            ->acceptJson()
            ->asJson()
            ->post('/sms/2/text/advanced', [
                'messages' => [
                    [
                        'from' => $this->config['sender_id'],
                        'destinations' => array_map(
                            fn (string $number): array => ['to' => $number],
                            $this->recipients
                        ),
                        'text' => $this->message,
                    ],
                ],
            ])
            ->json();

        $status = $response['messages'][0]['status']['groupName'] ?? null;

        if ($status === 'REJECTED' || isset($response['requestError'])) {
            $error = $response['requestError']['serviceException']['text'] ?? $response['messages'][0]['status']['description'] ?? 'Infobip API error';
            throw new SMSifyException($error);
        }

        return new ResponseDTO(
            success: in_array($status, ['PENDING', 'SENT', 'DELIVERED']),
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['base_url'])) {
            throw new SMSifyException('Please set base_url for Infobip in config/smsify.php.');
        }

        if (empty($this->config['username'])) {
            throw new SMSifyException('Please set username for Infobip in config/smsify.php.');
        }

        if (empty($this->config['password'])) {
            throw new SMSifyException('Please set password for Infobip in config/smsify.php.');
        }

        if (empty($this->config['sender_id'])) {
            throw new SMSifyException('Please set sender_id for Infobip in config/smsify.php.');
        }
    }
}
