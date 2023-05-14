<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Tercero;
use App\Models\Pais;
use App\Models\Maquina;
use App\Models\Lista;
use App\Models\Articulo;
use App\Models\Contacto;
use App\Models\ArticuloTemporal;
use App\Models\FotoArticulo;
use App\Models\FotoArticuloTemporal;


class PedidoController extends Controller
{

    public function index()
    {
        $pedidos = Pedido::with(['tercero', 'contacto', 'maquinas'])->get();
        return view('pedidos.index', compact('pedidos'));
    }


    public function create()
    {
        //obtener el ultimo pedido
        $ultimoPedido = Pedido::latest()->first();

        //obterner el ultimo pedido y sumarle 1
        $ultimoPedido = $ultimoPedido ? $ultimoPedido->id + 1 : 1;

        //obtener el usuario logueado
        $usuario = auth()->user();

        //obtener terceros
        $Terceros = Tercero::all();

        //obtener paises
        $paises = Pais::all();

        //obtener maquinas
        $maquinas = Maquina::all();

        //obtener sistemas desde listas
        $sistemas = Lista::where('tipo', 'sistema')->pluck('nombre', 'id');

        //obtener articulos
        $articulos = Articulo::all();


        //retornar la vista con los datos
        return view('pedidos.create')->with('ultimoPedido', $ultimoPedido)->with('usuario', $usuario)->with('Terceros', $Terceros)->with('paises', $paises)->with('maquinas', $maquinas)->with('sistemas', $sistemas)->with('articulos', $articulos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tercero_id' => 'nullable|exists:terceros,id',
            'user_id' => 'nullable|exists:users,id',
            'contacto_id' => 'nullable|exists:contactos,id',
            'comentario' => 'nullable|string',
            'estado' => 'nullable|string'
        ]);

        $pedido = new Pedido();
        $pedido->tercero_id = $request->input('tercero_id');
        $pedido->user_id = auth()->user()->id;
        $pedido->contacto_id = $request->input('contactoTercero');
        $pedido->comentario = $request->input('comentario');
        $pedido->estado = $request->input('estado');
        $pedido->save();

        // Agregar cada maquina al pedido
        $maquinas = $request->input('maquina_id', []);
        if ($maquinas) {
            foreach ($maquinas as $maquina) {
                $pedido->maquinas()->attach($maquina);
            }
        }

        // Crear los artículos temporales
    foreach ($request->articulos as $articulo) {
        $articuloTemporal = ArticuloTemporal::create([
            'pedido_id' => $pedido->id,
            'referencia' => $articulo['referencia'],
            'definicion' => $articulo['definicion'],
            'sistema' => $articulo['sistema'],
            'cantidad' => $articulo['cantidad'],
        ]);

        // Guardar las fotos del artículo temporal
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $fotoArticuloTemporal = new FotoArticuloTemporal;
                $fotoArticuloTemporal->articulo_temporal_id = $articuloTemporal->id;
                $fotoArticuloTemporal->ruta = $foto->store('public/fotos');
                $fotoArticuloTemporal->save();
            }
        }
    }
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
