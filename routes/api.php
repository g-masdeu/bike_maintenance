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

Route::post('/login', function(Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    $token = $user->createToken('httpie')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user->only(['id','name','email','role'])
    ]);
});

Route::middleware(['auth:sanctum'])->group(function () {

    // Usuari autenticat
    Route::get('/user', [UserController::class, 'show']);

    // Bicicletes CRUD
    Route::get('/bicicletas', [BicicletaController::class, 'index']);
    Route::post('/bicicletas', [BicicletaController::class, 'store']);

    Route::delete('/bicicletas/{bicicleta}', [BicicletaController::class, 'destroy']);

    // Manteniments
    Route::get('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'index']);
    Route::post('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'store']);
});


Route::get('/bicicletas/{bicicleta}', [BicicletaController::class, 'show']);

Route::put('/bicicletas/{bicicleta}', [BicicletaController::class, 'update']);

// Tipus de bicicletes
Route::get('/tipos', [TipoBicicletaController::class, 'index']);

// Marques de bicicletes
Route::get('/marcas', [MarcaBicicletaController::class, 'index']);

// Models filtrats per tipus i marca
Route::get('/modelos/{marca}/{tipo}', [ModeloBicicletaController::class, 'show']);
