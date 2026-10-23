<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Facades;

use Illuminate\Support\Facades\Facade;
use Revoltify\SMSify\DTOs\ResponseDTO;
use Revoltify\SMSify\SMSifyManager;

/**
 * @method static self to(string $number)
 * @method static self message(string $message)
 * @method static ResponseDTO send()
 * @method static self driver(?string $driver)
 *
 * @see SMSifyManager
 */
class SMSify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SMSifyManager::class;
    }
}
