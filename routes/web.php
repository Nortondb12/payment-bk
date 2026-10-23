<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Customer\PortalAccessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TextFileController;
use App\Http\Middleware\InitializeBrandifyByDomain;
use Illuminate\Support\Facades\Route;
use Revoltify\UddoktaPay\Http\Controllers\CronController;

Route::get('/', HomeController::class)->name('home');

Route::get('/login', LoginController::class)->name('login');

Route::post('/logout', LogoutController::class)->name('logout');

Route::middleware('auth')->prefix('system')->name('admin.cache.')->group(function (): void {
    Route::post('/clear', [CacheController::class, 'clear'])->name('clear');
    Route::post('/optimize', [CacheController::class, 'optimize'])->name('optimize');
});

Route::get('/cron/run/{key}', CronController::class)->name('cron.run');

Route::get('/customer/access/{token}', PortalAccessController::class)
    ->middleware('throttle:10,1')
    ->name('customer.access');

Route::middleware([InitializeBrandifyByDomain::class, 'set-locale'])->group(function (): void {
    require base_path('routes/coreweb.php');

    Route::prefix('{brand}')
        ->name('branded.')
        ->group(function (): void {
            require base_path('routes/coreweb.php');
        });
});

Route::get('{filename}', TextFileController::class)
    ->where('{filename}', '.*\.(txt|xml|html)$')
    ->name('textfile');
