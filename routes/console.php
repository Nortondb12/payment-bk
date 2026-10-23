<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schedule;

Schedule::call(function (): void {
    update_settings('last_cron_run', now()->toDateTimeString());
})->everyMinute();

Schedule::command('app:prune-initiated-payments')
    ->daily();

Schedule::command('app:check-update')
    ->daily();

Schedule::command('app:clean-activity-log')
    ->daily();

Schedule::command('app:sync-exchange-rates')
    ->everyFourHours();

Schedule::command('app:process-pending-payments')
    ->everyMinute()
    ->runInBackground();

/**
 * DEFAULT queue — parallel workers for notifications
 */
Schedule::command('queue:work --queue=default --sleep=1 --backoff=0 --max-jobs=25 --stop-when-empty --timeout=300 --tries=1')
    ->everyMinute()
    ->withoutOverlapping(5)
    ->runInBackground();

/**
 * UPDATE queue
 */
Schedule::command('queue:work --queue=update --sleep=1 --backoff=0 --max-jobs=1 --stop-when-empty --timeout=1000 --tries=1')
    ->everyMinute()
    ->runInBackground()
    ->withoutOverlapping(10);
