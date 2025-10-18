<?php

use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\MantenimientoController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Illuminate\Http\Request;

// Raíz: si está autenticado -> dashboard, si no -> welcome
Route::get('/', function (Request $request) {
    if ($request->user()) {
        $bicicletas = $request->user()->bicicletas;
        return view('dashboard', compact('bicicletas'));
    }
    return view('welcome');
})->name('home');

// Settings (perfil, contraseña, apariencia, 2FA)
Route::middleware(['auth'])->group(function () {

    // Mostrar formulario de perfil
    Route::get('settings/profile', function () {
        return view('profile.edit'); // tu nueva vista
    })->name('settings.profile');

    // Actualizar perfil
    Route::put('settings/profile', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_photo' => 'nullable|image|max:2048', // máximo 2MB
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path; // asegurarse que el modelo User tenga este campo
        }

        $user->save();

        return back()->with('status', 'Perfil actualitzat correctament.');
    })->name('settings.profile.update');

    // Password y apariencia
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Two-Factor
    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Bicicletas y mantenimientos
Route::middleware(['auth', 'verified'])->group(function () {

    // Lista de bicicletas
    Route::get('/bicicletas', [BicicletaController::class, 'index'])->name('bicicletas.index');

    // Crear bicicleta nueva
    Route::get('/bicicletas/new', [BicicletaController::class, 'create'])->name('bicicletas.create');

    // Guardar bicicleta
    Route::post('/bicicletas', [BicicletaController::class, 'store'])->name('bicicletas.store');

    // Mostrar, actualizar y eliminar bicicleta específica
    Route::get('/bicicletas/{bicicleta}', [BicicletaController::class, 'show'])->name('bicicletas.show');
    Route::put('/bicicletas/{bicicleta}', [BicicletaController::class, 'update'])->name('bicicletas.update');
    Route::delete('/bicicletas/{bicicleta}', [BicicletaController::class, 'destroy'])->name('bicicletas.destroy');

    // Mantenimientos de bicicletas
    Route::get('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'index'])
        ->name('bicicletas.mantenimientos.index');
    Route::post('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'store'])
        ->name('bicicletas.mantenimientos.store');
});

require __DIR__.'/auth.php';
