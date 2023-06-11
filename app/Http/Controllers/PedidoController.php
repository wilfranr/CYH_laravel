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
        $data = $request->validate([
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

        // Agregar cada máquina al pedido
        $maquinas = $request->input('maquina_id', []);
        if ($maquinas) {
            foreach ($maquinas as $maquina) {
                $pedido->maquinas()->attach($maquina);
            }
        }

        // Agregar cada artículo temporal al pedido
        $contadorArticulos = $request->input('articulos-temporales');

        for ($i = 1; $i <= $contadorArticulos; $i++) {
            // Validar los datos del artículo temporal
            $dataArticulo = $request->validate([
                "referencia{$i}" => ['nullable', 'string', 'max:255'],
                "definicion{$i}" => ['nullable', 'string', 'max:255'],
                "comentarios{$i}" => ['nullable', 'string', 'max:255'],
                // Otros campos del artículo temporal
            ]);

            // Crear el artículo temporal
            $articuloTemporal = new ArticuloTemporal();
            $articuloTemporal->referencia = $request->input("referencia{$i}");
            $articuloTemporal->definicion = $request->input("definicion{$i}");
            $articuloTemporal->sistema = $request->input("sistema{$i}");
            $articuloTemporal->cantidad = $request->input("cantidad{$i}");
            $articuloTemporal->comentarios = $request->input("comentarios{$i}");

            $articuloTemporal->save();

            // Obtener las fotos del formulario
            $fotos = $request->file("fotos{$i}");

            if ($fotos) {
                foreach ($fotos as $foto) {
                    // Generar un nombre único para la foto
                    $nombreFoto = uniqid() . '.' . $foto->getClientOriginalExtension();

                    // Almacenar la foto en la carpeta de almacenamiento
                    $foto->storeAs('fotos-articulo-temporal', $nombreFoto, 'public');

                    // Crear una instancia de FotoArticuloTemporal
                    $fotoArticuloTemporal = new FotoArticuloTemporal();
                    $fotoArticuloTemporal->articuloTemporal()->associate($articuloTemporal);
                    $fotoArticuloTemporal->foto_path = $nombreFoto;
                    $fotoArticuloTemporal->save();
                }
            }



            // Agregar la relación a la tabla pivot
            $pedido->articulosTemporales()->attach($articuloTemporal->id);
        }

        // Redirigir o hacer cualquier otra acción necesaria
        // ...

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
    }


    public function show(Pedido $pedido, $id)
    {
        // Obtener el pedido con sus relaciones
        $pedido = Pedido::with(['tercero', 'contacto', 'maquinas', 'articulosTemporales.fotosArticuloTemporal', 'articulos'])->find($id);

        // Obtener todos los artículos asociados al pedido
        $articulos = $pedido->articulos;

        $sistemas = Lista::where('tipo', 'sistema')->pluck('nombre', 'id');
        $definiciones = Lista::where('tipo', 'Definición')->pluck('nombre');

        // Obtener las definiciones con su respectiva foto de medida
        $definicionesConFoto = Lista::where('tipo', 'Definición')->select('nombre', 'fotoMedida')->get();

        $definicionesFotoMedida = [];
        foreach ($definicionesConFoto as $definicion) {
            $definicionesFotoMedida[$definicion->nombre] = $definicion->fotoMedida;
        }

        $medidas = Lista::where('tipo', 'Medida')->pluck('nombre', 'id');
        $unidadMedidas = Lista::where('tipo', 'Unidad medida')->pluck('nombre', 'id');
        $maquinas = Lista::where('tipo', 'marca')->pluck('nombre', 'id');

        return view('pedidos.show', compact('pedido', 'sistemas', 'maquinas', 'medidas', 'unidadMedidas', 'articulos', 'definiciones', 'definicionesFotoMedida', 'definicion'));
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
            $contadorArticulos = 1; // Inicializa el contador

            foreach ($articulosTemporales as $articuloTemporalData) {
                $articuloTemporal = new ArticuloTemporal();
                $articuloTemporal->pedido_id = $pedido->id;
                $articuloTemporal->referencia = $request->input("referencia{$contadorArticulos}");
                $articuloTemporal->definicion = $request->input("definicion{$contadorArticulos}");
                $articuloTemporal->comentarios = $request->input("comentarios{$contadorArticulos}");
                // Asigna otros campos del artículo temporal si es necesario

                $articuloTemporal->save();

                $contadorArticulos++; // Incrementa el contador después de cada iteración
            }
        }



        return redirect()->route('pedidos.show', ['id' => $pedido->id])
            ->with('success', 'Pedido actualizado satisfactoriamente.');
    }

    public function detachArticulo($pedidoId, $articuloId)
    {
        $pedido = Pedido::findOrFail($pedidoId);
        $pedido->articulos()->detach($articuloId);

        return redirect()->back()->with('message', 'La relación entre el pedido y el artículo ha sido eliminada.');
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
