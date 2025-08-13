<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        App\Providers\AppServiceProvider::class,
        Pest\Laravel\PestServiceProvider::class,
    ])
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'ensure-api-key' => \App\Http\Middleware\EnsureApiKeyIsValid::class,
        ]);

        $middleware->group('api', ['ensure-api-key', 'throttle:60,1']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();