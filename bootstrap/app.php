<?php

use App\Http\Middleware\EnsureConsumerAuthenticated;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\CheckJobTitle;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function (): void {
            Route::middleware('web')
                ->namespace('App\\Http\\Controllers')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->namespace('App\\Http\\Controllers')
                ->group(base_path('routes/api.php'));

            Route::get('/up', fn () => response()->json([
                'status' => 'ok',
                'service' => config('app.name'),
                'time' => now()->toIso8601String(),
            ]))->name('health');
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'consumer' => EnsureConsumerAuthenticated::class,
            'job.title' => CheckJobTitle::class,
        ]);

        $middleware->redirectGuestsTo(fn (Request $request): string =>
            $request->is('consumers/*')
                ? route('consumers.login')
                : route('login')
        );
    })
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->command('daily_check')->daily();
    })
    ->withCommands([
        __DIR__.'/../app/Console/Commands',
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request): bool => $request->is('api/*') || $request->expectsJson(),
        );
    })
    ->create();
