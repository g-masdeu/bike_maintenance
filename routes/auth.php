<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail; // Vista de "Por favor verifica tu email"
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Rutas para mostrar las páginas (Livewire)
    // Útiles si el usuario va a /login directamente en vez de usar el modal
    Route::get('register', Register::class)->name('register');
    Route::get('login', Login::class)->name('login');
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');

    // RUTAS NUEVAS (POST) para que funcionen tus MODALES HTML
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Pantalla de "Verifica tu correo"
    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    // Acción de verificar el link del correo
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Acción de reenviar el correo de verificación
    Route::post('email/verification-notification', [VerifyEmailController::class, 'store']) // Asegúrate que tu VerifyEmailController tenga este método o usa una notificación simple
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});