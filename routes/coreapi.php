<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\PaymentApiController;
use App\Http\Controllers\OrderboxController;
use App\Http\Controllers\ShopifyController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function (): void {
    Route::get('/', fn () => abort(404))->name('api');
    // UddoktaPay API
    Route::controller(PaymentApiController::class)->group(function (): void {
        Route::middleware(['validate.api.uddoktapay'])->group(function (): void {
            Route::post('checkout/{type?}', 'checkout')->middleware('uddoktapay.ability:payment:checkout');
            Route::post('checkout-v2/{type?}', 'checkoutLatest')->middleware('uddoktapay.ability:payment:checkout');
            Route::post('refund-payment', 'refund')->middleware('uddoktapay.ability:payment:refund');
        });

        Route::post('verify-payment/{invoice_id?}', 'verify')
            ->middleware([
                'validate.api.verify.uddoktapay',
                'uddoktapay.verify.ability:payment:verify',
            ]);
    });

    Route::middleware([HandleInertiaRequests::class, 'set-locale'])->group(function (): void {
        Route::get('orderbox/checkout/{track_id}', [OrderboxController::class, 'checkout'])->name('orderbox.checkout');
        Route::get('shopify/checkout/{track_id}', [ShopifyController::class, 'checkout'])->name('shopify.checkout');
    });
});
