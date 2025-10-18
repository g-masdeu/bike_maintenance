<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bicicleta;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index(Bicicleta $bicicleta, Request $request)
    {
        $this->authorize('view', $bicicleta);
        return response()->json($bicicleta->mantenimientos);
    }

    public function store(Bicicleta $bicicleta, Request $request)
    {
        $this->authorize('update', $bicicleta);

        $data = $request->validate([
            'mantenimiento_id' => 'required|exists:mantenimientos,id',
            'fecha_realizado' => 'required|date',
            'kms_al_realizar' => 'required|integer',
        ]);

        $bicicleta->mantenimientos()->attach($data['mantenimiento_id'], [
            'fecha_realizado' => $data['fecha_realizado'],
            'kms_al_realizar' => $data['kms_al_realizar'],
        ]);

        return response()->json(['message' => 'Manteniment afegit correctament']);
    }
}
