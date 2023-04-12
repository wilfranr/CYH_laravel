<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Ciudad;
use Illuminate\Support\Facades\DB;
use Debugbar;


class CiudadController extends Controller

{
    public function getCiudadesByPais($codigo_pais)
{
    try {
        $ciudades = Ciudad::where('PaisCodigo', $codigo_pais)->get();
        return response()->json(['ciudades' => $ciudades]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
