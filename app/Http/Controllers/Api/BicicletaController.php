<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bicicleta;
use Illuminate\Http\Request;

class BicicletaController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->bicicletas()->with(['tipo', 'marca', 'mantenimientos'])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'model' => 'required|string|max:255',
            'marca_id' => 'required|exists:marca_bicicletas,id',
            'tipo_id' => 'required|exists:tipo_bicicletas,id',
            'data_compra' => 'required|date',
            'kms_actuals' => 'nullable|integer',
            'kms_ultimo_mantenimiento' => 'nullable|integer',
        ]);

        $bicicleta = $request->user()->bicicletas()->create($data);

        return response()->json($bicicleta, 201);
    }

    public function show(Bicicleta $bicicleta, Request $request)
    {
        $this->authorize('view', $bicicleta); // si vols control de permisos
        return response()->json($bicicleta->load(['tipo', 'marca', 'mantenimientos']));
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $this->authorize('update', $bicicleta);

        $data = $request->validate([
            'model' => 'sometimes|string|max:255',
            'marca_id' => 'sometimes|exists:marca_bicicletas,id',
            'tipo_id' => 'sometimes|exists:tipo_bicicletas,id',
            'kms_actuals' => 'sometimes|integer',
            'kms_ultimo_mantenimiento' => 'sometimes|integer',
        ]);

        $bicicleta->update($data);
        return response()->json($bicicleta);
    }

    public function destroy(Bicicleta $bicicleta)
    {
        $this->authorize('delete', $bicicleta);
        $bicicleta->delete();
        return response()->json(['message' => 'Bicicleta eliminada correctament']);
    }
}
