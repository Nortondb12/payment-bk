<?php

declare(strict_types=1);

use App\Filament\Resources\ApiKeys\Pages\EditApiKey;
use App\Filament\Resources\BankGateways\Pages\EditGateway as EditBankGateway;
use App\Filament\Resources\Brands\Pages\EditBrand;
use App\Filament\Resources\Currencies\Pages\EditCurrency;
use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Faqs\Pages\EditFaq;
use App\Filament\Resources\Gateways\Pages\EditGateway;
use App\Filament\Resources\Invoices\Pages\EditInvoice;
use App\Filament\Resources\Liquids\Pages\EditLiquid;
use App\Filament\Resources\MfsTransactions\Pages\EditMfsTransaction;
use App\Filament\Resources\NotificationChannels\Pages\EditNotificationChannel;
use App\Filament\Resources\Orderboxes\Pages\EditOrderbox;
use App\Filament\Resources\PaymentLinks\Pages\ViewPaymentLink;
use App\Filament\Resources\Payments\Pages\ViewPayment;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\TextFiles\Pages\EditTextFile;
use App\Filament\Resources\Users\Pages\EditUser;

return [
    /*
    |--------------------------------------------------------------------------
    | Subject Edit Pages
    |--------------------------------------------------------------------------
    |
    | Maps model class to its Filament edit/view page for linking.
    |
    */

    'edit_pages' => [
        'api-key' => EditApiKey::class,
        'brand' => EditBrand::class,
        'currency' => EditCurrency::class,
        'customer' => EditCustomer::class,
        'faq' => EditFaq::class,
        'gateway' => EditGateway::class,
        'bank-gateway' => EditBankGateway::class,
        'invoice' => EditInvoice::class,
        'liquid' => EditLiquid::class,
        'mfs-transaction' => EditMfsTransaction::class,
        'notification-channel' => EditNotificationChannel::class,
        'orderbox' => EditOrderbox::class,
        'payment' => ViewPayment::class,
        'payment-link' => ViewPaymentLink::class,
        'role' => EditRole::class,
        'text-file' => EditTextFile::class,
        'user' => EditUser::class,
    ],
];
