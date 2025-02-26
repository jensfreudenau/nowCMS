<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Sentry\Laravel\Integration;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'upload/*',
            'upload/',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        Integration::handles($exceptions);
//        $exceptions->render(function (NotFoundHttpException $exception, Request $request) {
//            Log::info($exception->getMessage(), [
//                'url' => $request->url(),
//                'exception' => $exception->getTraceAsString()
//            ]);
//        });
//        $exceptions->render(function (InvalidArgumentException $exception, Request $request) {
//            Log::error($exception->getMessage(), [
//                'url' => $request->url(),
//                'exception' => $exception->getTraceAsString()
//            ]);
//        });
    })->create();
