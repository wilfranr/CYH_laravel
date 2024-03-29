<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Tercero;

class CosteoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['tercero'])->get();
        return view('costeos.index', compact('pedidos'));
    }

    public function costear(Pedido $pedido, $id)
    {
        $pedido = Pedido::with(['tercero', 'contacto', 'maquinas', 'articulosTemporales.fotosArticuloTemporal', 'articulos'])->find($id);
        //traer todos los terceros donde PaisCodigo = COL y tipo = proveedor
        $proveedoresNacionales = Tercero::where('PaisCodigo', 'COL')->where('tipo', 'proveedor')->get();
        $proveedoresInternacionales = Tercero::where('PaisCodigo', '!=', 'COL')->where('tipo', 'proveedor')->get();

        return view('costeos.costear', compact('pedido', 'proveedoresNacionales', 'proveedoresInternacionales'));
    }

    
}
