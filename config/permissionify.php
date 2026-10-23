<?php

declare(strict_types=1);

use App\Filament\Clusters\AccessManagement\AccessManagementCluster;
use App\Filament\Clusters\Gateways\GatewaysCluster;
use App\Filament\Clusters\Reports\Reports;
use App\Filament\Clusters\SmsData\SmsDataCluster;
use App\Filament\Pages\EditProfile;
use App\Filament\Resources\Activities\ActivityResource;
use App\Filament\Resources\ApiKeys\ApiKeyResource;
use App\Filament\Resources\BankGateways\BankGatewayResource;
use App\Filament\Resources\Brands\BrandResource;
use App\Filament\Resources\Currencies\CurrencyResource;
use App\Filament\Resources\Customers\CustomerResource;
use App\Filament\Resources\Devices\DeviceResource;
use App\Filament\Resources\Faqs\FaqResource;
use App\Filament\Resources\Gateways\GatewayResource;
use App\Filament\Resources\Invoices\InvoiceResource;
use App\Filament\Resources\Liquids\LiquidResource;
use App\Filament\Resources\MfsTransactions\MfsTransactionResource;
use App\Filament\Resources\NotificationChannels\NotificationChannelResource;
use App\Filament\Resources\Orderboxes\OrderboxResource;
use App\Filament\Resources\PaymentLinks\PaymentLinkResource;
use App\Filament\Resources\Payments\PaymentResource;
use App\Filament\Resources\Roles\RoleResource;
use App\Filament\Resources\Shopifies\ShopifyResource;
use App\Filament\Resources\TextFiles\TextFileResource;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Widgets\ReportsOverview;
use App\Models\Permission;
use App\Models\Role;
use Filament\Pages\Dashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

return [
    // Model classes for roles and permissions
    'models' => [
        'role' => Role::class,
        'permission' => Permission::class,
    ],

    // Resource discovery across panels
    'discover_all_panels' => false,

    // Excluded resources, pages, and widgets
    'excludes' => [
        'resources' => [],
        'pages' => [
            Dashboard::class,
            AccessManagementCluster::class,
            Reports::class,
            GatewaysCluster::class,
            SmsDataCluster::class,
            EditProfile::class,
        ],
        'widgets' => [
            AccountWidget::class,
            FilamentInfoWidget::class,
            ReportsOverview::class,
        ],
    ],

    // Default permissions for resources, pages, and widgets
    'default_permissions' => [
        'resources' => [
            'viewAny',
            'view',
            'create',
            'update',
            'delete',
            'deleteAny',
            'restore',
            'restoreAny',
            'forceDelete',
            'forceDeleteAny',
            'replicate',
            'reorder',
        ],
        'pages' => ['view'],
        'widgets' => ['view'],
    ],

    // Custom permission overrides
    'overrides' => [
        ActivityResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        ApiKeyResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        BankGatewayResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
            'reorder',
            'replicate',
        ],
        BrandResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        CurrencyResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        CustomerResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
            'export',
            'import',
            'managePortal',
        ],
        DeviceResource::class => [
            'viewAny',
            'delete',
            'deleteAny',
            'connect',
        ],
        FaqResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        GatewayResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
            'reorder',
        ],
        InvoiceResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
            'restore',
            'restoreAny',
            'forceDelete',
            'forceDeleteAny',
            'replicate',
            'markAsPaid',
            'Approve',
            'Cancel',
            'SendUnpaidMail',
        ],
        LiquidResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        MfsTransactionResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
            'forceDelete',
            'forceDeleteAny',
            'restoreAny',
        ],
        NotificationChannelResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        OrderboxResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        PaymentLinkResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
            'copyDefault',
        ],
        PaymentResource::class => [
            'viewAny',
            'update',
            'delete',
            'deleteAny',
            'approve',
            'approveAny',
            'refund',
            'sendIpn',
            'TransferDetails',
            'ViewActivity',
        ],
        RoleResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        ShopifyResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
            'deploy',
        ],
        TextFileResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
        UserResource::class => [
            'viewAny',
            'create',
            'update',
            'delete',
            'deleteAny',
        ],
    ],
];
