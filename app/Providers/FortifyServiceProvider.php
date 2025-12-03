<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        // Aquí solían estar las vistas de 2FA y Confirmación de contraseña.
        // Las hemos quitado porque ya no usas esa lógica.

        // Limitador de tasa para el Login (5 intentos por minuto)
        RateLimiter::for('login', function (Request $request) {
             return Limit::perMinute(5)->by(strtolower($request->email) . '|' . $request->ip());
        });
    }
}