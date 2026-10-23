<?php

declare(strict_types=1);

namespace Revoltify\SMSify\DTOs;

final readonly class ResponseDTO
{
    public function __construct(
        public bool $success,
        public array $data = [],
        public array $errors = [],
    ) {}

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'errors' => $this->errors,
        ];
    }
}
