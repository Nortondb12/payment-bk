<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AppLoginController;
use App\Http\Controllers\Api\IphoneSmsController;
use App\Http\Controllers\MfsTransactionController;
use App\Http\Middleware\Api\VerifyIphoneApiSecret;
use App\Http\Middleware\InitializeBrandifyByDomain;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function (): void {
    Route::prefix('app')->group(function (): void {
        Route::post('login', [AppLoginController::class, 'login']);
        Route::post('login-with-qr', [AppLoginController::class, 'loginWithQrCode']);

        Route::post('iphone/sms/{secret}', IphoneSmsController::class)
            ->middleware([VerifyIphoneApiSecret::class])
            ->where('secret', '[a-f0-9]{64}')
            ->name('iphone.sms.store');

        Route::middleware(['auth:sanctum'])->group(function (): void {
            Route::post('logout', [AppLoginController::class, 'logout']);
            Route::post('sms/store', [MfsTransactionController::class, 'store']);
        });
    });
});

Route::middleware([InitializeBrandifyByDomain::class])->group(function (): void {
    require base_path('routes/coreapi.php');

    Route::prefix('{brand}')
        ->name('branded.')
        ->group(function (): void {
            require base_path('routes/coreapi.php');
        });
});
