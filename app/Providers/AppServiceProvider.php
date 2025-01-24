<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinutes(5, 3) //Rate limit 3 requests per 5 minutes
                ->by($request->input('username'))
                ->response(function () {
                    return response()->json([
                        'success' => false,
                        'message' => 'Too many requests',
                        'data' => [],
                    ], 429);
                });
        });
    }
}
