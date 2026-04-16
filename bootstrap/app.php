<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin*')) {
                return route('admin.login');
            }
            return route('home');
        });

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'tenant' => \App\Http\Middleware\TenantMiddleware::class,
        ]);

        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                // Validation Error
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'status' => 422,
                        'message' => $e->errors(),
                        'errors' => $e->errors(),
                    ], 422);
                }
                // Unauthenticated
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'status' => 401,
                        'message' => 'Unauthenticated, Please Login first..',
                    ], 401);
                }
                // Route Not Found
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'API route not found. Please check typo Error or API url',
                    ], 404);
                }
                // Default Error
                return response()->json([
                    'status' => 500,
                    'message' => config('app.debug')
                        ? $e->getMessage()
                        : 'Something went wrong',
                ], 500);
            }
        });
    })->create();
