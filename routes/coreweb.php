<?php

declare(strict_types=1);

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LiquidController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OrderboxController;
use App\Http\Controllers\PaymentLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', LocaleController::class)
    ->where(['locale' => '[A-Za-z_-]+'])
    ->name('locale.switch');

Route::controller(InvoiceController::class)->prefix('invoice')->group(function (): void {
    Route::get('/pay/{track_id}', 'checkout')->name('invoice.checkout');
});

Route::controller(LiquidController::class)->prefix('liquid')->group(function (): void {
    Route::get('/pay/{track_id}', 'index')->name('liquid.home');
    Route::post('/pay/{track_id}', 'checkout')->name('liquid.checkout');
});

Route::controller(PaymentLinkController::class)
    ->prefix('paymentlink')
    ->name('paymentlink.')
    ->group(function (): void {
        Route::get('/default/{currency?}', 'index')->name('default');
        Route::post('/default', 'store')->name('store');
        Route::get('/pay/{track_id}', 'show')->name('show');
        Route::post('/pay/{track_id}', 'checkout')->name('checkout');
    });

// Checkout process routes
Route::prefix('checkout')->name('checkout.')->group(function (): void {
    // System routes
    Route::controller(CheckoutController::class)->group(function (): void {
        Route::get('/success', 'successPage')->name('success.page');
        Route::get('/pending', 'pendingPage')->name('pending.page');
        Route::get('/cancel', 'cancelPage')->name('cancel.page');

        Route::prefix('{token}')->where(['token' => '[A-Za-z0-9_-]+'])->group(function (): void {
            Route::get('/', 'index')->name('home');
            Route::get('/cancel', 'cancel')->name('cancel');
            Route::get('/pay/{code}', 'pay')->name('pay')
                ->where(['code' => '[A-Za-z0-9_-]+']);
        });
    });

    // Orderbox routes
    Route::get('orderbox/success', [OrderboxController::class, 'success'])->name('orderbox.success');
});

// Gatewayify Route
Route::gatewayify(GatewayController::class, name: 'gateway');

Route::passkeys();
