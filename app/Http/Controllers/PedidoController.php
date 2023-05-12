<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Tercero;
use App\Models\Pais;
use App\Models\Maquina;
use App\Models\Lista;
use App\Models\Articulo;


class PedidoController extends Controller
{

    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        //obtener el ultimo pedido
        $ultimoPedido = Pedido::latest()->first();

        //obterner el ultimo pedido y sumarle 1
        $ultimoPedido = $ultimoPedido ? $ultimoPedido->codPedido + 1 : 1;

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
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $rutaFoto = $foto->store('public/fotos');
                // aquí guarda la ruta de la foto en la base de datos o en un arreglo, según sea necesario
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
