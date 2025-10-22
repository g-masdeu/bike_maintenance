<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\TipoBicicleta;
use App\Models\MarcaBicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BicicletaController extends Controller
{
    // Llista bicicletes de l'usuari
    public function index(Request $request)
    {
        $bicicletas = $request->user()->bicicletas()->with(['tipo', 'marca'])->get();

        if ($request->wantsJson()) {
            return response()->json($bicicletas);
        }

        return view('bicicletas.index', compact('bicicletas'));
    }

    public function create()
    {
        $marcas = \App\Models\MarcaBicicleta::all();
        $tipos = \App\Models\TipoBicicleta::all();

        return view('bicicletas.create', compact('marcas', 'tipos'));
    }

    // Veure una bici concreta
    public function show(Bicicleta $bicicleta, Request $request)
    {
        $this->checkOwnership($bicicleta);

        // Devuelve siempre JSON
        return response()->json($bicicleta->load(['tipo', 'marca', 'mantenimientos']));
    }


    // Crear bicicleta nova
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

        if ($request->wantsJson()) {
            return response()->json($bicicleta, 201);
        }

        return redirect()->route('home')->with('success', 'Bicicleta creada correctament');
    }

    // Actualitzar bicicleta
    public function update(Request $request, Bicicleta $bicicleta)
    {
        $this->checkOwnership($bicicleta);

        $data = $request->validate([
            'model' => 'sometimes|string|max:255',
            'marca_id' => 'sometimes|exists:marca_bicicletas,id',
            'tipo_id' => 'sometimes|exists:tipo_bicicletas,id',
            'kms_actuals' => 'sometimes|integer',
            'kms_ultimo_mantenimiento' => 'sometimes|integer',
        ]);

        $bicicleta->update($data);

        if ($request->wantsJson()) {
            return response()->json($bicicleta);
        }

        return redirect()->back()->with('success', 'Bicicleta actualitzada correctament');
    }

    // Esborrar bicicleta
    public function destroy(Bicicleta $bicicleta, Request $request)
    {
        $this->checkOwnership($bicicleta);
        $bicicleta->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Bicicleta eliminada correctament']);
        }

        return redirect()->back()->with('success', 'Bicicleta eliminada correctament');
    }

    // Comprovació que la bici pertany a l'usuari
    private function checkOwnership(Bicicleta $bicicleta)
    {
        if ($bicicleta->user_id !== Auth::id()) {
            abort(403, 'No tens permisos per accedir a aquesta bicicleta.');
        }
    }
}
