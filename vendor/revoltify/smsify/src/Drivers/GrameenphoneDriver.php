<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Support\Facades\Http;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;

final class GrameenphoneDriver extends AbstractDriver
{
    private string $baseUrl = 'https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2';

    protected function execute(): ResponseDTO
    {
        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->retry($this->retry, $this->retryDelay)
            ->acceptJson()
            ->asJson()
            ->post('', [
                'username' => $this->config['username'],
                'password' => $this->config['password'],
                'apicode' => 1, // 1 for sending
                'msisdn' => implode(',', $this->recipients),
                'countrycode' => '880',
                'cli' => $this->config['cli'] ?? '2222',
                'messagetype' => $this->config['message_type'] ?? 1, // 1=Text, 2=Flash, 3=Unicode
                'messageid' => 0,
                'message' => $this->message,
            ])
            ->json();

        $statusCode = $response['statusCode'] ?? null;

        if ($statusCode !== 200 && $statusCode !== '200') {
            throw new SMSifyException($response['statusDescription'] ?? 'Grameenphone API error');
        }

        return new ResponseDTO(
            success: true,
            data: $response,
        );
    }

    protected function validate(): void
    {
        if (empty($this->config['username'])) {
            throw new SMSifyException('Please set username for Grameenphone in config/smsify.php.');
        }

        if (empty($this->config['password'])) {
            throw new SMSifyException('Please set password for Grameenphone in config/smsify.php.');
        }
    }
}
