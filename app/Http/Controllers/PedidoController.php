<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;


class PedidoController extends Controller
{

    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codPedido' => 'required',
            'codUsuario' => 'required',
            'codCliente' => 'required',
            'codMaquina' => 'required',
            'fecha_creacion' => 'required',
            'descripcion' => 'required',
            'contacto' => 'required',
            'estado' => 'required',
        ]);

        Pedido::create($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido creado satisfactoriamente.');
    }

    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'codPedido' => 'required',
            'codUsuario' => 'required',
            'codCliente' => 'required',
            'codMaquina' => 'required',
            'fecha_creacion' => 'required',
            'descripcion' => 'required',
            'contacto' => 'required',
            'estado' => 'required',
        ]);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido actualizado satisfactoriamente.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado satisfactoriamente.');
    }
}
