<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MantenimientoController extends Controller
{
    // Llista manteniments d'una bicicleta
    public function index(Bicicleta $bicicleta, Request $request)
    {
        $this->checkOwnership($bicicleta);

        $mantenimientos = $bicicleta->mantenimientos()->get();

        if ($request->wantsJson()) {
            return response()->json($mantenimientos);
        }

        return view('mantenimientos.index', compact('bicicleta', 'mantenimientos'));
    }

    // Afegir manteniment a una bicicleta
    public function store(Bicicleta $bicicleta, Request $request)
    {
        $this->checkOwnership($bicicleta);

        $data = $request->validate([
            'mantenimiento_id' => 'required|exists:mantenimientos,id',
            'fecha_realizado' => 'required|date',
            'kms_al_realizar' => 'required|integer',
        ]);

        $bicicleta->mantenimientos()->attach($data['mantenimiento_id'], [
            'fecha_realizado' => $data['fecha_realizado'],
            'kms_al_realizar' => $data['kms_al_realizar'],
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Manteniment afegit correctament']);
        }

        return redirect()->route('bicicletas.show', $bicicleta)->with('success', 'Manteniment afegit correctament');
    }

    // Comprovació de propietat
    private function checkOwnership(Bicicleta $bicicleta)
    {
        if ($bicicleta->user_id !== Auth::id()) {
            abort(403, 'No tens permisos per accedir a aquesta bicicleta.');
        }
    }
}
