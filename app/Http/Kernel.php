<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Barryvdh\Cors\HandleCors::class,
        \App\Http\Middleware\Errors::class,
        \App\Http\Middleware\TrimStrings::class,
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class
        ],

        'api' => [
            'throttle:60,1',
            'bindings'
        ]
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'             => \App\Http\Middleware\Authenticate::class,
        'can'              => \Illuminate\Auth\Middleware\Authorize::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'cache.headers'    => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'guest'            => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'         => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'signed'           => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'bindings'         => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'verified'         => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'auth.basic'       => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Auth\Middleware\Authorize::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class
    ];
}
