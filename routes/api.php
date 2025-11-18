<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BicicletaController;
use App\Http\Controllers\Api\MantenimientoController;
use App\Http\Controllers\Api\TipoBicicletaController;
use App\Http\Controllers\Api\MarcaBicicletaController;
use App\Http\Controllers\Api\ModeloBicicletaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// 🔐 Login
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    $token = $user->createToken('httpie')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user->only(['id', 'name', 'email', 'role']),
    ]);
});

// 🔒 Rutas protegidas con autenticación Sanctum
Route::middleware(['auth:sanctum'])->group(function () {

    // 👤 Usuario autenticado
    Route::get('/user', [UserController::class, 'show']);

    // 🚴‍♂️ Bicicletas CRUD
    Route::get('/bicicletas', [BicicletaController::class, 'index']);
    Route::post('/bicicletas', [BicicletaController::class, 'store']);
    Route::get('/bicicletas/{bicicleta}', [BicicletaController::class, 'show']);
    Route::delete('/bicicletas/{bicicleta}', [BicicletaController::class, 'destroy']);

    // 🛠️ Mantenimientos (historial + registro + comprobación)
    Route::get('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'index']);
    Route::post('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'store']);
    Route::get('/bicicletas/{bicicleta}/mantenimientos/check', [MantenimientoController::class, 'checkNecesidad']);
});

// 🏷️ Tipos, marcas y modelos públicos
Route::put('/bicicletas/{bicicleta}', [BicicletaController::class, 'update']);
Route::get('/tipos', [TipoBicicletaController::class, 'index']);
Route::get('/marcas', [MarcaBicicletaController::class, 'index']);
Route::get('/modelos/{marca}/{tipo}', [ModeloBicicletaController::class, 'show']);
