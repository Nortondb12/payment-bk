<?php

declare(strict_types=1);

namespace Revoltify\SMSify;

use Illuminate\Contracts\Container\Container;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Revoltify\SMSify\Commands\InstallSMSifyCommand;
use Revoltify\SMSify\Notifications\SMSifyChannel;

class SMSifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register config
        $this->mergeConfigFrom(
            __DIR__.'/../config/smsify.php',
            'smsify'
        );

        $this->app->singleton(
            SMSifyManager::class,
            fn (Container $container): SMSifyManager => new SMSifyManager($container)
        );

        Notification::resolved(function (ChannelManager $channel): void {
            $channel->extend('smsify', fn ($app) => $app->make(SMSifyChannel::class));
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            // Publish config
            $this->publishes([
                __DIR__.'/../config/smsify.php' => config_path('smsify.php'),
            ], 'smsify-config');

            // Register commands
            $this->commands([
                InstallSMSifyCommand::class,
            ]);
        }
    }
}
