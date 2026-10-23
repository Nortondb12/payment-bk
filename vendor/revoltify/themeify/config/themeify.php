<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Active Theme
    |--------------------------------------------------------------------------
    |
    | It will assign the default active theme to be used if one is not set during
    | runtime.
    */
    'active' => 'nova',

    /*
    |--------------------------------------------------------------------------
    | Base Path
    |--------------------------------------------------------------------------
    |
    | The base path where all the themes are located.
    */
    'base_path' => base_path('themes'),

    /*
    |--------------------------------------------------------------------------
    | Inertia
    |--------------------------------------------------------------------------
    |
    | Settings applied when the active theme declares the Inertia engine. The
    | root view is resolved through the theme's own view paths.
    |
    | Under an Inertia theme a dotted view renders as a page component, and the
    | name maps to a component path (checkout.checkout => checkout/checkout). A
    | view the application already owns as Blade stays on Blade, as does any
    | namespaced one a package owns, so a provider handoff page keeps rendering
    | underneath an Inertia theme.
    */
    'inertia' => [
        'root_view' => 'app',
    ],
];
