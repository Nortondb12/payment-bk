<?php

declare(strict_types=1);

namespace Revoltify\SMSify\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'smsify:install', description: 'Install the SMSify package and publish the configuration')]
final class InstallSMSifyCommand extends Command
{
    public function handle(): int
    {
        $this->publishConfigs();

        return self::SUCCESS;
    }

    private function publishConfigs(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'smsify-config',
        ]);
    }
}
