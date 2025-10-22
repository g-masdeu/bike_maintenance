<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoBicicletaController extends Controller
{
    public function index() {
        return response()->json(DB::table('tipo_bicicletas')->get());
    }
}
