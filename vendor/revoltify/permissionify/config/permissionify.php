<?php

declare(strict_types=1);

use Filament\Pages\Dashboard;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return [
    // Navigation settings for Roles
    'navigations' => [
        'group' => 'Administration',
        'icon' => Heroicon::OutlinedShieldCheck,
        'label' => 'Roles',
        'sort' => 100,
    ],

    // Model classes for roles and permissions
    'models' => [
        'role' => Role::class,
        'permission' => Permission::class,
    ],

    // Resource discovery across panels
    'discover_all_panels' => true,

    // Excluded resources, pages, and widgets
    'excludes' => [
        'resources' => [],
        'pages' => [
            Dashboard::class,
        ],
        'widgets' => [
            AccountWidget::class,
            FilamentInfoWidget::class,
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
        // \App\Filament\Resources\Users\UserResource::class => [
        //     'viewAny',
        //     'create',
        //     'update',
        //     'delete',
        //     'deleteAny',
        //     'suspend', // custom
        // ],
    ],
];
