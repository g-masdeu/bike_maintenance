<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ModeloBicicletaController extends Controller
{
    // Nuevo método para recibir parámetros de la URL
    public function show($marcaId, $tipo)
    {
        $modelos = DB::table('modelo_bicicletas')
            ->where('marca_id', $marcaId)
            ->where('tipo', $tipo)
            ->get();

        return response()->json($modelos);
    }

    // Método index opcional para listar todos los modelos
    public function index()
    {
        $modelos = DB::table('modelo_bicicletas')->get();
        return response()->json($modelos);
    }
}
