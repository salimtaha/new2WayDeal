<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    public const AdminHome ='/admin/welcome';

    public  const CharityHome = '/charities/welcome';
    public const MediatorHome = '/mediators/welcome';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

                Route::middleware('web')
                ->group(base_path('routes/web.php'));

                Route::middleware('web')
                ->group(base_path('routes/admin.php'));
                Route::middleware('web')
                ->group(base_path('routes/charity.php'));
                Route::middleware('web')
                ->group(base_path('routes/mediator.php'));

                // amr  modefied verified to apiverified
                Route::middleware(['auth:sanctum','apiverified'])
                ->prefix('api/me')
                ->group(base_path('routes/user.php'));
                Route::middleware(['auth:sanctum','apiverified','approved'])
                ->prefix('api/seller')
                ->group(base_path('routes/seller.php'));

        });










    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('verify', function (Request $request) {
            return Limit::perHour(5)->by($request->ip());
        });

        RateLimiter::for('reset', function (Request $request) {
            return Limit::perHour(500)->by($request->ip());
        });

        RateLimiter::for('otp', function (Request $request) {
            return Limit::perHour(500)->by($request->ip());
        });

        RateLimiter::for('change', function (Request $request) {
            return Limit::perHour(500)->by($request->ip());
        });
    }
}
