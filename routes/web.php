<?php

use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\LanguageController;
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
    /** @var \Illuminate\Contracts\Auth\Guard $auth */ // <-- ¡Añade esta línea!
    $auth = auth();

    return Auth::check()        
        ? redirect('/dashboard')
        : view('welcome');
})->name('home');

// Tu dashboard (sin cambios)
Route::middleware('auth')->get('/dashboard', function (Request $request) {
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
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        return back()->with('status', 'Perfil actualizado correctamente.');
    })->name('settings.profile.update');

    // Password & Appearance
    Route::get('password', Password::class)->name('settings.password');
    Route::get('appearance', Appearance::class)->name('settings.appearance');

    // Two-Factor Authentication (requires password confirmation)
    Route::middleware('password.confirm')->get('two-factor', TwoFactor::class)
        ->name('two-factor.show');
});

/*
|--------------------------------------------------------------------------
| Bicicletas & Mantenimientos
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| OAuth Login (Google / GitHub)
|--------------------------------------------------------------------------
*/
Route::prefix('oauth')->group(function () {
    Route::get('{provider}/redirect', [OAuthController::class, 'redirect'])
        ->where('provider', 'google|github')
        ->name('oauth.redirect');

    Route::get('{provider}/callback', [OAuthController::class, 'callback'])
        ->where('provider', 'google|github')
        ->name('oauth.callback');
});

require __DIR__ . '/auth.php';
