<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \App\Http\Middleware\TrimStrings::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\RoleMiddleware::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareGroups = [
        'api' => [
            'throttle:60,1',
            'bindings',
            \App\Http\Middleware\AuthGates::class,
        ],
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\TestMiddleware::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\RoleMiddleware::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\AuthGates::class,
            \App\Http\Middleware\SetLocale::class,
        ],
    ];

    protected $routeMiddleware = [
        'can'              => \Illuminate\Auth\Middleware\Authorize::class,
        'role'             => \App\Http\Middleware\RoleMiddleware::class,
        'auth'             => \Illuminate\Auth\Middleware\Authenticate::class,
        'test'             => \App\Http\Middleware\TestMiddleware::class,
        'guest'            => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed'           => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'         => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'cache.headers'    => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'bindings'         => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'auth.basic'       => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    ];
}
