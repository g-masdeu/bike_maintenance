<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BicicletaController;
use App\Http\Controllers\Api\MantenimientoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    // Usuari autenticat
    Route::get('/user', [UserController::class, 'show']);

    // Bicicletes CRUD
    Route::get('/bicicletas', [BicicletaController::class, 'index']);
    Route::get('/bicicletas/{bicicleta}', [BicicletaController::class, 'show']);
    Route::post('/bicicletas', [BicicletaController::class, 'store']);
    Route::put('/bicicletas/{bicicleta}', [BicicletaController::class, 'update']);
    Route::delete('/bicicletas/{bicicleta}', [BicicletaController::class, 'destroy']);

    // Manteniments
    Route::get('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'index']);
    Route::post('/bicicletas/{bicicleta}/mantenimientos', [MantenimientoController::class, 'store']);
});
