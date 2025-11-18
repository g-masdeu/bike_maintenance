<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bicicleta;
use Illuminate\Http\Request;

class BicicletaController extends Controller
{
    // Listar bicicletas del usuario
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->bicicletas()->with(['tipo', 'marca', 'mantenimientos'])->get()
        );
    }

    // Crear bicicleta
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

        // Inicializamos kms_ultimo_mantenimiento = kms_actuals si no se pasa
        if (!isset($data['kms_ultimo_mantenimiento'])) {
            $data['kms_ultimo_mantenimiento'] = $data['kms_actuals'] ?? 0;
        }

        $bicicleta = $request->user()->bicicletas()->create($data);

        return response()->json($bicicleta, 201);
    }

    // Mostrar bicicleta
    public function show(Bicicleta $bicicleta)
    {
        return response()->json($bicicleta->load(['tipo', 'marca', 'mantenimientos']));
    }

    // Actualizar bicicleta
    public function update(Request $request, Bicicleta $bicicleta)
    {
        $data = $request->validate([
            'model' => 'sometimes|string|max:255',
            'marca_id' => 'sometimes|exists:marca_bicicletas,id',
            'tipo_id' => 'sometimes|exists:tipo_bicicletas,id',
            'kms_actuals' => 'sometimes|integer',
            'kms_ultimo_mantenimiento' => 'sometimes|integer',
        ]);

        $bicicleta->update($data);

        $kmsIntervals = $bicicleta->kms_actuals - $bicicleta->kms_ultimo_mantenimiento;
        $timeIntervals = now()->diffInDays($bicicleta->data_ultimo_mantenimiento);

        if ($kmsIntervals >= 300) {
            $bicicleta->kms_ultimo_mantenimiento = $bicicleta->kms_actuals;

        }

        $bicicleta->save();
        return response()->json($bicicleta);
    }

    // Eliminar bicicleta
    public function destroy(Bicicleta $bicicleta)
    {
        $this->authorize('delete', $bicicleta);
        $bicicleta->delete();
        return response()->json(['message' => 'Bicicleta eliminada']);
    }
}
