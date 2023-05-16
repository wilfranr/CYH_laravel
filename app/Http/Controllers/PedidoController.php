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

        // Agregar cada articulo al pedido
        $data = [
            'contadorArticulos' => $request->input('contadorArticulos'),
            // Otros datos que necesites
        ];
        for ($i = 1; $i <= $data['contadorArticulos']; $i++) {
            // Validar los datos del formulario del artículo temporal
            $dataArticulo = $request->validate([
                'referencia' . $i => ['nullable', 'string', 'max:255'],
                'definicion' . $i => ['nullable', 'string', 'max:255'],
                'comentario' . $i => ['nullable', 'string', 'max:255'],
            ]);

            // Crear el artículo temporal
            $articuloTemporal = new ArticuloTemporal();
            $articuloTemporal->pedido_id = $pedido->id;
            $articuloTemporal->referencia = $request->input('referencia' . $i);
            $articuloTemporal->definicion = $request->input('definicion' . $i);
            $articuloTemporal->comentarios = $request->input('comentario' . $i);
            $articuloTemporal->save();

            // Agregar la relación a la tabla pivot
            $pedido->articulosTemporales()->attach($articuloTemporal->id);
        }

        // Sincronizar los artículos asociados al pedido
        $pedido->articulosTemporales()->sync($request->articulosTemporales);

        return redirect()->route('pedidos.show', ['id' => $pedido->id])
            ->with('success', 'El pedido se ha creado exitosamente.');



        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido creado satisfactoriamente.');
    }

    public function show(Pedido $pedido, $id)
    {
        $pedido = Pedido::with(['tercero', 'contacto', 'maquinas', 'articulosTemporales'])->find($id);

        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $articulosTemporales = $pedido->articulosTemporales;

        return view('pedidos.edit', compact('pedido', 'articulosTemporales'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'nullable|string',
            'estado' => 'nullable|string'
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->comentario = $request->input('comentario');
        $pedido->estado = $request->input('estado');
        $pedido->save();

        // Actualizar los artículos temporales asociados al pedido
        // Actualizar los registros relacionados en la relación "hasMany"
        $articulosTemporales = $request->input('articulos-temporales');

        if (!is_null($articulosTemporales)) {
            foreach ($articulosTemporales as $articuloTemporalData) {
                $articuloTemporal = ArticuloTemporal::find($articuloTemporalData['id']);
                $articuloTemporal->referencia = $articuloTemporalData['referencia'];
                $articuloTemporal->definicion = $articuloTemporalData['definicion'];
                // ... actualizar otros campos del articuloTemporal ...
                $articuloTemporal->save();
            }
        }

        return redirect()->route('pedidos.show', ['id' => $pedido->id])
            ->with('success', 'Pedido actualizado satisfactoriamente.');
    }


    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido) {
            $pedido->delete();
            return redirect()->route('pedidos.index')->with('success', 'Tercero eliminado correctamente');
        } else {
            return redirect()->route('pedidos.index')->with('error', 'No se pudo eliminar el tercero');
        }
    }
}
