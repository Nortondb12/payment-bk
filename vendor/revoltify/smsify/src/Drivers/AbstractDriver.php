<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Drivers;

use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Support\Str;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\Exceptions\SMSifyException;
use Revoltify\SMSify\Jobs\SendSmsJob;

abstract class AbstractDriver
{
    protected array $recipients = [];

    protected string $message = '';

    protected int $timeout;

    protected int $retry;

    protected int $retryDelay;

    /**
     * Create a new driver instance.
     */
    public function __construct(
        protected array $config = [],
    ) {
        $this->timeout = config()->integer('smsify.request.timeout');
        $this->retry = config()->integer('smsify.request.retry');
        $this->retryDelay = config()->integer('smsify.request.retry_delay');
    }

    /**
     * Send the message
     */
    abstract protected function execute(): ResponseDTO;

    /**
     * Send the message immediately.
     */
    final public function send(): ResponseDTO
    {
        $this->ensureRequiredParametersAreSet();

        $this->validate();

        return $this->execute();
    }

    /**
     * Queue the message for later sending.
     */
    final public function queue(?string $queue = null, ?string $connection = null): PendingDispatch
    {
        $this->ensureRequiredParametersAreSet();

        $this->validate();

        $job = new SendSmsJob(
            driver: $this->getDriverName(),
            recipients: $this->recipients,
            message: $this->message,
        );

        if ($queue) {
            $job->onQueue($queue);
        }

        if ($connection) {
            $job->onConnection($connection);
        }

        return dispatch($job);
    }

    /**
     * Set the recipient number(s)
     *
     * @param  string|array<string>  $numbers
     */
    final public function to(string|array $numbers): self
    {
        $this->recipients = array_map(
            $this->formatPhoneNumber(...),
            is_array($numbers) ? $numbers : [$numbers]
        );

        return $this;
    }

    /**
     * Set the message content
     */
    final public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the driver name for queue purposes.
     */
    protected function getDriverName(): string
    {
        $className = class_basename(static::class);

        return Str::of($className)
            ->before('Driver')
            ->lower()
            ->toString();
    }

    /**
     * Standardizes BD phone numbers to 8801XXXXXXXXX format.
     */
    protected function formatPhoneNumber(string $number): string
    {
        $phone = Str::of($number)
            ->replaceMatches('/\D/', '')
            ->ltrim('88')
            ->ltrim('0')
            ->prepend('880')
            ->toString();

        if (! preg_match('/^8801[3-9]\d{8}$/', $phone)) {
            throw SMSifyException::invalidNumber($number);
        }

        return $phone;
    }

    // Ensure that required parameters are set before sending
    private function ensureRequiredParametersAreSet(): void
    {
        if ($this->recipients === []) {
            throw SMSifyException::missingRecipient();
        }

        if ($this->message === '' || $this->message === '0') {
            throw SMSifyException::missingMessage();
        }
    }

    /**
     * Validate driver-specific configuration.
     * Override this method in child classes if needed.
     */
    protected function validate(): void
    {
        // Optional: Child classes can override for custom validation
    }
}
