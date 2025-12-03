<?php

use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\LanguageController;
// He eliminado el OAuthController que ya no existe
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Home / Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect('/dashboard')
        : view('welcome');
})->name('home');

// CAMBIO: Añadido middleware 'verified' para obligar a confirmar email
Route::middleware(['auth', 'verified'])->get('/dashboard', function (Request $request) {
    // Nota: Asegúrate de que la relación 'bicicletas' exista en tu modelo User
    $bicicletas = $request->user()->bicicletas;
    return view('dashboard', compact('bicicletas'));
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Language Switching
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])
    ->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Settings (Profile, Password, Appearance, Two-Factor)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('settings')->group(function () {

    // Profile
    Route::get('profile', function () {
        return view('profile.edit');
    })->name('settings.profile');

    Route::put('profile', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = $request->user();
        $user->fill($request->only('name', 'email'));

        if ($request->hasFile('profile_photo')) {
            // CORRECCIÓN: Tu migración usa 'profile_photo', no 'profile_photo_path'
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Si el email cambia, invalidamos la verificación para que tenga que confirmar de nuevo
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return back()->with('status', 'Perfil actualizado correctamente.');
    })->name('settings.profile.update');

    // Password & Appearance
    Route::get('password', Password::class)->name('settings.password');
    Route::get('appearance', Appearance::class)->name('settings.appearance');

    // Two-Factor (Si usas 2FA por código TOTP con Livewire, déjalo. Si no, puedes borrarlo).
    Route::middleware('password.confirm')->get('two-factor', TwoFactor::class)
        ->name('two-factor.show');
});

/*
|--------------------------------------------------------------------------
| Bicicletas & Mantenimientos
|--------------------------------------------------------------------------
*/
// Este grupo ya tenía 'verified', ¡perfecto!
Route::middleware(['auth', 'verified'])->prefix('bicicletas')->group(function () {

    // Bicicletas CRUD
    Route::get('/', [BicicletaController::class, 'index'])->name('bicicletas.index');
    Route::get('/new', [BicicletaController::class, 'create'])->name('bicicletas.create');
    Route::post('/', [BicicletaController::class, 'store'])->name('bicicletas.store');
    Route::put('/{bicicleta}', [BicicletaController::class, 'update'])->name('bicicletas.update');
    Route::delete('/{bicicleta}', [BicicletaController::class, 'destroy'])->name('bicicletas.destroy');

    // Mantenimientos
    Route::get('/{bicicleta}/mantenimientos', [MantenimientoController::class, 'index'])
        ->name('bicicletas.mantenimientos.index');
    Route::post('/{bicicleta}/mantenimientos', [MantenimientoController::class, 'store'])
        ->name('bicicletas.mantenimientos.store');
});

// He eliminado completamente el bloque de rutas OAuth

require __DIR__ . '/auth.php';