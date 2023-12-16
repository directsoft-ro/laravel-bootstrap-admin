<?php

return [
    'domain' => env('ADMIN_DOMAIN'),

    'middleware_aliases' => [
        'admin.auth' => \DirectsoftRo\LaravelBootstrapAdmin\Http\Middleware\Authenticate::class,
        'admin.guest' => \DirectsoftRo\LaravelBootstrapAdmin\Http\Middleware\RedirectIfAuthenticated::class,
    ],
];
