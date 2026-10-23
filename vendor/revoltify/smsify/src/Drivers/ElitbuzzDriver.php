<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class ElitbuzzDriver extends AbstractDriver
{
    protected function execute(): ResponseDTO
    {
        $response = Http::timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->asForm()
            ->post($this->config['url'].'/smsapi', [
                'api_key' => $this->config['api_key'],
                'type' => $this->config['type'] ?? 'text',
                'senderid' => $this->config['sender_id'],
                'contacts' => implode(',', $this->recipients),
                'msg' => $this->message,
            ]);

        $body = $response->body();

        if (str_contains(mb_strtolower($body), 'error') || str_contains(mb_strtolower($body), 'fail')) {
            throw new SMSifyException($body ?: 'ElitBuzz API error');
        }

        return new ResponseDTO(
            success: true,
            data: ['response' => $body],
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['url'])) {
            throw new SMSifyException('Please set url for ElitBuzz in config/smsify.php.');
        }

        if (empty($this->config['api_key'])) {
            throw new SMSifyException('Please set api_key for ElitBuzz in config/smsify.php.');
        }

        if (empty($this->config['sender_id'])) {
            throw new SMSifyException('Please set sender_id for ElitBuzz in config/smsify.php.');
        }
    }
}
