<?php

return [

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost,127.0.0.1')),

    'expiration' => null,

    'middleware' => [
        'verify_csrf_token' => \Illuminate\Auth\Middleware\Authenticate::class,
        'encrypt_cookies' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
    ],
];
