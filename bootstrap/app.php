<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function (\Illuminate\Http\Response $response) {
            // In production, show custom error pages for all error codes
            if (!app()->environment('local') && in_array($response->status(), [500, 503, 404, 403])) {
                return \Inertia\Inertia::render('Error', ['status' => $response->status()])
                    ->toResponse(request())
                    ->setStatusCode($response->status());
            }

            // In local development, show custom error pages for 404 and 403
            // but let Laravel show detailed errors for 500/503
            if (app()->environment('local') && in_array($response->status(), [404, 403])) {
                return \Inertia\Inertia::render('Error', ['status' => $response->status()])
                    ->toResponse(request())
                    ->setStatusCode($response->status());
            }

            return $response;
        });
    })->create();
