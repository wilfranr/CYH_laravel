<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lista;
use App\Models\Maquina;
use App\Models\Medida;
use App\Models\Pedido;


class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::all();

        return view('articulos.index', compact('articulos'));
    }

    public function create()
    {
        $articulos = Articulo::all();
        $sistemas = Lista::where('tipo', 'sistema')->pluck('nombre', 'id');
        $definiciones = Lista::where('tipo', 'Definición')->pluck('nombre');

        // Obtener las definiciones con su respectiva foto de medida
        $definicionesConFoto = Lista::where('tipo', 'Definición')->select('nombre', 'fotoMedida')->get();

        $definicionesFotoMedida = [];
        foreach ($definicionesConFoto as $definicion) {
            $definicionesFotoMedida[$definicion->nombre] = $definicion->fotoMedida;
        }


        //dd($definicionesFotoMedida);

        $medidas = Lista::where('tipo', 'Medida')->pluck('nombre', 'id');
        $unidadMedidas = Lista::where('tipo', 'Unidad medida')->pluck('nombre', 'id');
        $maquinas = Lista::where('tipo', 'marca')->pluck('nombre', 'id');

        return view('articulos.create', compact('sistemas', 'maquinas', 'medidas', 'unidadMedidas', 'articulos', 'definiciones', 'definicionesFotoMedida', 'definicion'));
    }



    public function store(Request $request, Articulo $articulo)
    {
        $validatedData = $request->validate([
            //'maquina' => 'nullable|exists:maquinas,id',
            //'tipo_maquina' => 'nullable|exists:maquinas,id',
            'marca' => 'nullable|string',
            //'sistema' => 'nullable|string',
            'select-definicion' => 'nullable|string',
            'referencia' => 'nullable|string',
            'descripcion_especifica' => 'nullable|string',
            'comentarios' => 'nullable|string',
            'peso' => 'nullable|string',
            'foto' => 'nullable|image|max:2048', // Agregamos validación para imágenes
        ]);
        //dd($request->all()) ;

        $articulo = new Articulo();
        //$articulo->maquina_id = $validatedData['maquina'];
        //$articulo->tipo_maquina_id = $validatedData['tipo_maquina'];
        $articulo->marca = $validatedData['marca'];
        // $articulo->sistema = $validatedData['sistema'];
        $articulo->definicion = $validatedData['select-definicion'];
        $articulo->referencia = $validatedData['referencia'];
        $articulo->descripcionEspecifica = $validatedData['descripcion_especifica'];
        $articulo->comentarios = $validatedData['comentarios'];
        $articulo->peso = $validatedData['peso'];

        // Procesar la foto descriptiva del artículo, si se proporcionó
        if ($request->hasFile('foto-descriptiva')) {
            $fotoDescriptiva = $request->file('foto-descriptiva');
            $filename = time() . '_' . $fotoDescriptiva->getClientOriginalName();
            $filepath = $fotoDescriptiva->storeAs('public/articulos', $filename);
            $articulo->fotoDescriptiva = $filename;
        } else {
            $articulo->fotoDescriptiva = 'no-imagen.jpg';
        }

        // Procesar la foto de la medida, si se proporcionó
        if ($request->hasFile('fotoMedida2')) {
            $fotoMedida = $request->file('fotoMedida2');
            $filename = time() . '_' . $fotoMedida->getClientOriginalName();
            $filepath = $fotoMedida->storeAs('public/articulos', $filename);
            $articulo->fotoMedida = $filename;
        } else {
            $articulo->fotoMedida = 'no-imagen.jpg';
        }


        // Asociar las máquinas con el artículo
        $maquinas = Maquina::all();
        foreach ($maquinas as $maquina) {
            $maquina->articulos()->attach($articulo->id, ['fabricante' => $request->fabricante, 'tipo_maquina' => $request->tipo_maquina]);
        }


        $articulo->save();
        // Verificar si el artículo está asociado a un pedido
        if ($request->has('pedido_id')) {
            $pedido = Pedido::find($request->pedido_id);

            // Verificar si se encontró el pedido
            if ($pedido) {
                // Asociar el artículo al pedido mediante la relación muchos a muchos
                $pedido->articulos()->attach($articulo->id);
            }
        }

        // Crear las medidas del articulo
        //si no se ingresan meiddas, continuar

        // Obtener los datos del formulario de medidas
        $dataMedida = $request->only(['contadorMedidas', 'tipoMedida', 'valorMedida', 'unidadMedida', 'idMedida']);

        // Verificar si el índice 'tipoMedida' existe
        if (isset($dataMedida['tipoMedida'])) {
            // Obtener el contador de medidas
            $contadorMedidas = $dataMedida['contadorMedidas'];

            // Recorrer el bucle para crear y asociar las medidas al artículo
            for ($i = 0; $i < $contadorMedidas; $i++) {
                $medida = new Medida();

                // Verificar si el índice 'tipoMedida' en la posición $i existe
                if (isset($dataMedida['tipoMedida'][$i])) {
                    $medida->nombre = $dataMedida['tipoMedida'][$i];
                }

                // Verificar si el índice 'valorMedida' en la posición $i existe
                if (isset($dataMedida['valorMedida'][$i])) {
                    $medida->valor = $dataMedida['valorMedida'][$i];
                }

                // Verificar si el índice 'unidadMedida' en la posición $i existe
                if (isset($dataMedida['unidadMedida'][$i])) {
                    $medida->unidad = $dataMedida['unidadMedida'][$i];
                }

                // Verificar si el índice 'idMedida' en la posición $i existe
                if (isset($dataMedida['idMedida'][$i])) {
                    $medida->idMedida = $dataMedida['idMedida'][$i];
                }


                $medida->save();

                // Asociar la medida al artículo en la tabla pivot
                $articulo->medidas()->attach($medida->id);
            }
        }

        //redireccionar recargando la pagina
        return redirect()->route('articulos.create')->with('success', 'Artículo creado correctamente.');
    }

    public function show(Articulo $articulo, $id)
    {
        $articulo = Articulo::find($id);
        $definiciones = Lista::where('tipo', 'Descripcion comun')->pluck('nombre', 'fotoMedida', 'id');

        return view('articulos.show', compact('articulo', 'definiciones'));
    }


    public function edit($id)
    {
        // Obtener el artículo que se va a editar
        $articulo = Articulo::findOrFail($id);

        // Obtener las medidas del artículo
        $medidas = $articulo->medidas;

        //obtener las definiciones de la lista 
        $definiciones = Lista::where('tipo', 'Descripcion comun')->pluck('nombre', 'id');
        $tipoMedida = Lista::where('tipo', 'Medida')->pluck('nombre', 'id');
        $unidades = Lista::where('tipo', 'Unidad medida')->pluck('nombre', 'id');

        //obtener la marca
        $marca = Lista::where('tipo', 'marca')->get();

        // Mostrar la vista de edición con los datos del artículo y sus medidas
        return view('articulos.edit', compact('articulo', 'medidas', 'definiciones', 'marca', 'unidades', 'tipoMedida'));
    }

    public function update(Request $request, Articulo $articulo)
    {
        $validatedData = $request->validate([
            'marca' => 'nullable|string',
            'definicion' => 'nullable|string',
            'referencia' => 'nullable|string',
            'descripcion_especifica' => 'nullable|string',
            'comentarios' => 'nullable|string',
            'peso' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Actualizar los campos del artículo
        $articulo->marca = $validatedData['marca'];
        $articulo->definicion = $validatedData['definicion'];
        $articulo->referencia = $validatedData['referencia'];
        $articulo->descripcionEspecifica = $validatedData['descripcion_especifica'];
        $articulo->comentarios = $validatedData['comentarios'];
        $articulo->peso = $validatedData['peso'];

        // Procesar la foto descriptiva del artículo, si se proporcionó
        if ($request->hasFile('foto-descriptiva')) {
            $fotoDescriptiva = $request->file('foto-descriptiva');
            $filename = time() . '_' . $fotoDescriptiva->getClientOriginalName();
            $filepath = $fotoDescriptiva->storeAs('public/articulos', $filename);
            $articulo->fotoDescriptiva = $filename;
        }

        // Guardar los cambios
        $articulo->save();

        // Actualizar las medidas del artículo
        $dataMedida = $request->validate([
            'contadorMedidas' => ['required', 'integer', 'min:1'],
            'fotoMedida' => ['nullable', 'string', 'max:255'],
            'tipoMedida' => ['nullable', 'string', 'max:255'],
            'valorMedida' => ['nullable', 'string', 'max:255'],
            'unidadMedida' => ['nullable', 'string', 'max:255'],
            'idMedida' => ['nullable', 'string', 'max:255'],
        ]);

        // Eliminar todas las medidas antiguas del artículo
        $articulo->medidas()->delete();

        // Crear las nuevas medidas del artículo
        $medidas = [];
        for ($i = 1; $i <= $dataMedida['contadorMedidas']; $i++) {
            $medida = new Medida();
            $medida->nombre = $dataMedida['tipoMedida'][$i - 1] ?? null;
            $medida->valor = $dataMedida['valorMedida'][$i - 1] ?? null;
            $medida->unidad = $dataMedida['unidadMedida'][$i - 1] ?? null;
            $medida->idMedida = $dataMedida['idMedida'][$i - 1] ?? null;

            // Procesar la foto de la medida, si se proporcionó
            if ($request->hasFile('fotoMedida' . $i)) {
                $fotoMedida = $request->file('fotoMedida' . $i);
                $filename = time() . '_' . $fotoMedida->getClientOriginalName();
                $filepath = $fotoMedida->storeAs('public/medidas', $filename);
                $medida->foto = $filename;
            } else {
                $medida->foto = 'no-imagen.jpg';
            }
            // Guardar la medida
            $medida->save();
            $medidas[] = $medida;
        }
        // Asociar las medidas al artículo
        $articulo->medidas()->saveMany($medidas);
        // Redireccionar al usuario
        return redirect()->route('articulos.index')->with('success', 'Artículo actualizado correctamente.');
    }

    public function definicion(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'nombre' => 'required',
            'definicion' => 'required',
            'fotoLista' => 'image|nullable',
            'fotoMedida' => 'image|nullable'
        ]);

        $lista = new Lista;
        $lista->tipo = $request->tipo;
        $lista->nombre = $request->nombre;
        $lista->definicion = $request->definicion;

        // Procesar la foto de la lista, si se proporcionó
        if ($request->hasFile('fotoLista')) {
            $foto = $request->file('fotoLista');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $filepath = $foto->storeAs('public/listas', $filename);
            $lista->foto = $filename;
        } else {
            $lista->foto = 'no-imagen.jpg';
        }

        // Procesar la foto de la medida si se proporcionó
        if ($request->hasFile('fotoMedida')) {
            $foto = $request->file('fotoMedida');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $filepath = $foto->storeAs('public/listas', $filename);
            $lista->fotoMedida = $filename;
        } else {
            $lista->fotoMedida = 'no-imagen.jpg';
        }

        $lista->save();

        return redirect()->route('articulos.create')->with('success', 'La lista ha sido creada exitosamente.');
    }

    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        if ($articulo) {
            $articulo->delete();
            return redirect()->route('articulos.index')->with('success', 'Artículo eliminado correctamente');
        } else {
            return redirect()->route('articulos.index')->with('error', 'No se pudo eliminar el artículo');
        }
    }
}
