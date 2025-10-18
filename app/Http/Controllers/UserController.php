<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bicicleta;

class UserController extends Controller
{
    /**
     * Devuelve los datos del usuario autenticado
     */
    public function me(Request $request)
    {
        $user = $request->user(); // Usuario autenticado
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'is_active' => $user->is_active,
        ]);
    }


    public function bicicletas(Request $request)
    {
        $bicicletas = $request->user()->bicicletas()->get();

        return response()->json($bicicletas);
    }

}
