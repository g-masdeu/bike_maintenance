<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bicicleta;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MantenimientoController extends Controller
{
    // 🔹 Listar mantenimientos realizados de una bicicleta
    public function index(Bicicleta $bicicleta, Request $request)
    {
        $this->authorize('view', $bicicleta);

        $mantenimientos = $bicicleta->mantenimientos()
            ->withPivot('fecha_realizado', 'kms_al_realizar')
            ->get();

        return response()->json($mantenimientos);
    }

    // 🔹 Registrar un nuevo mantenimiento realizado
    public function store(Bicicleta $bicicleta, Request $request)
    {
        $data = $request->validate([
            'mantenimiento_id' => 'required|exists:mantenimientos,id',
            'fecha_realizado' => 'required|date',
            'kms_al_realizar' => 'required|integer',
        ]);

        $bicicleta->mantenimientos()->attach($data['mantenimiento_id'], [
            'fecha_realizado' => $data['fecha_realizado'],
            'kms_al_realizar' => $data['kms_al_realizar'],
        ]);

        return response()->json(['message' => 'Mantenimiento añadido correctamente']);
    }

    // 🔹 Comprobar si la bicicleta necesita algún mantenimiento
    public function checkNecesidad(Bicicleta $bicicleta)
    {
        $this->authorize('view', $bicicleta);

        // Mantenimientos aplicables a este tipo de bici (o genéricos)
        $mantenimientos = Mantenimiento::whereNull('tipo_bici_id')
            ->orWhere('tipo_bici_id', $bicicleta->tipo_bici_id)
            ->get();

        $resultados = [];

        foreach ($mantenimientos as $mantenimiento) {
            // Buscar el último mantenimiento de ese tipo
            $ultimo = DB::table('bicicleta_mantenimiento')
                ->where('bicicleta_id', $bicicleta->id)
                ->where('mantenimiento_id', $mantenimiento->id)
                ->orderByDesc('fecha_realizado')
                ->first();

            if (!$ultimo) {
                // Nunca se ha hecho este mantenimiento
                $resultados[] = [
                    'mantenimiento' => $mantenimiento->nom,
                    'necesita' => true,
                    'motivos' => ['Nunca se ha realizado este mantenimiento.'],
                ];
                continue;
            }

            $kmsDesdeUltimo = $bicicleta->kms_actuals - $ultimo->kms_al_realizar;
            $diasDesdeUltimo = now()->diffInDays($ultimo->fecha_realizado);

            $necesita = false;
            $motivos = [];

            if ($mantenimiento->kms_interval && $kmsDesdeUltimo >= $mantenimiento->kms_interval) {
                $necesita = true;
                $motivos[] = "Ha superado los {$mantenimiento->kms_interval} km recomendados.";
            }

            if ($mantenimiento->time_interval && $diasDesdeUltimo >= $mantenimiento->time_interval) {
                $necesita = true;
                $motivos[] = "Han pasado más de {$mantenimiento->time_interval} días desde el último mantenimiento.";
            }

            $resultados[] = [
                'mantenimiento' => $mantenimiento->nom,
                'necesita' => $necesita,
                'motivos' => $motivos,
                'kms_desde_ultimo' => $kmsDesdeUltimo,
                'dias_desde_ultimo' => $diasDesdeUltimo,
                'ultima_fecha' => $ultimo->fecha_realizado,
            ];
        }

        return response()->json([
            'bicicleta_id' => $bicicleta->id,
            'mantenimientos' => $resultados,
        ]);
    }
}
