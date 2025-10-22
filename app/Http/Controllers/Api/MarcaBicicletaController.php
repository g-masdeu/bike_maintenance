<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MarcaBicicletaController extends Controller
{

    public function index()
    {
        $marcas = DB::table('marca_bicicletas')->get();

        return response()->json($marcas);
    }
}
