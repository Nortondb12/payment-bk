<?php

declare(strict_types=1);

use App\Http\Middleware\Api\V1\CheckAbilities;
use App\Http\Middleware\Api\V1\ValidateApi;
use App\Http\Middleware\Api\V1\ValidateVerifyApi;
use App\Http\Middleware\Api\V1\VerifyCheckAbilities;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Sentry\Laravel\Integration;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: base_path('routes/web.php'),
        api: base_path('routes/api.php'),
        commands: base_path('routes/console.php'),
        health: '/uptime',
        apiPrefix: '',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');

        $middleware->validateCsrfTokens(except: [
            'api/*',
            '*/api/*',
            'gateway/*',
            '*/gateway/*',
        ]);

        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);

        $middleware->alias([
            'set-locale' => SetLocale::class,
            'validate.api.uddoktapay' => ValidateApi::class,
            'validate.api.verify.uddoktapay' => ValidateVerifyApi::class,
            'uddoktapay.ability' => CheckAbilities::class,
            'uddoktapay.verify.ability' => VerifyCheckAbilities::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        if (app()->isProduction()) {
            try {
                Integration::handles($exceptions);
            } catch (Exception) {
                //  Do nothing if Sentry is not configured properly
            }
        }

        $exceptions->shouldRenderJsonWhen(fn (Request $request, Throwable $e): bool => $request->is('api/*') || $request->expectsJson());

        $exceptions->respond(function (Response $response) {
            $status = $response->getStatusCode();

            if (request()->is('api/*') || request()->expectsJson()) {
                return match ($status) {
                    Response::HTTP_FOUND => response()->json([
                        'status' => 'error',
                        'message' => 'An unexpected redirect occurred',
                    ], Response::HTTP_FOUND),

                    Response::HTTP_UNAUTHORIZED => response()->json([
                        'status' => 'error',
                        'message' => 'Unauthorized request',
                    ], Response::HTTP_UNAUTHORIZED),

                    Response::HTTP_NOT_FOUND => response()->json([
                        'status' => 'error',
                        'message' => 'Not Found',
                    ], Response::HTTP_NOT_FOUND),

                    Response::HTTP_METHOD_NOT_ALLOWED => response()->json([
                        'status' => 'error',
                        'message' => 'Method not allowed',
                    ], Response::HTTP_METHOD_NOT_ALLOWED),

                    Response::HTTP_FORBIDDEN => response()->json([
                        'status' => 'error',
                        'message' => 'Forbidden access',
                    ], Response::HTTP_FORBIDDEN),

                    Response::HTTP_TOO_MANY_REQUESTS => response()->json([
                        'status' => 'error',
                        'message' => 'Too many requests',
                    ], Response::HTTP_TOO_MANY_REQUESTS),

                    Response::HTTP_INTERNAL_SERVER_ERROR => response()->json([
                        'status' => 'error',
                        'message' => 'Internal server error',
                    ], Response::HTTP_INTERNAL_SERVER_ERROR),

                    default => $response,
                };
            }

            return $response;
        });
    })->create();
