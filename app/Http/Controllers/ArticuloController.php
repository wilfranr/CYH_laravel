<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lista;
use App\Models\Maquina;
use App\Models\Medida;


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
        $definiciones = Lista::where('tipo', 'Definición')->pluck('nombre', 'id');

        // Obtener las definiciones con su respectiva foto de medida
        $definicionesConFoto = Lista::where('tipo', 'Definición')->select('id', 'fotoMedida')->get();

        $definicionesFotoMedida = [];
        foreach ($definicionesConFoto as $definicion) {
            $definicionesFotoMedida[$definicion->id] = $definicion->fotoMedida;
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
            'definicion' => 'nullable|string',
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
        } else {
            $articulo->fotoDescriptiva = 'no-imagen.jpg';
        }

        // Procesar la foto de la medida, si se proporcionó
        if ($request->hasFile('fotoMedida')) {
            $fotoMedida = $request->file('fotoMedida');
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
        // dd($contadorMedidas);
        // Crear las medidas del articulo
        //si no se ingresan meiddas, continuar

        // Obtener los datos del formulario de medidas
        $dataMedida = $request->only(['contadorMedidas', 'tipoMedida', 'valorMedida', 'unidadMedida', 'idMedida']);

        // Crear y asociar las medidas al artículo
        for ($i = 0; $i < $dataMedida['contadorMedidas']; $i++) {
            $medida = new Medida();
            $medida->nombre = $dataMedida['tipoMedida'][$i] ?: null;
            $medida->valor = $dataMedida['valorMedida'][$i] ?: null;
            $medida->unidad = $dataMedida['unidadMedida'][$i] ?: null;
            $medida->idMedida = $dataMedida['idMedida'][$i] ?: null;
            $medida->save();

            // Asociar la medida al artículo en la tabla pivot
            $articulo->medidas()->attach($medida->id);
        }








        return redirect()->route('articulos.show', $articulo->id)->with('success', 'Artículo agregado correctamente.');
    }

    public function show(Articulo $articulo, $id)
    {
        $articulo = Articulo::find($id);

        return view('articulos.show', compact('articulo'));
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
