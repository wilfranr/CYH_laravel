<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lista;
use App\Models\Maquina;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::all();

        return view('articulos.index', compact('articulos'));
    }

    public function create()
    {
        $sistemas = Lista::where('tipo', 'sistema')->pluck('nombre', 'id');
        $definiciones = Lista::where('tipo', 'Descripción común')->pluck('nombre', 'id');
        $maquinas = Lista::where('tipo', 'marca')->pluck('nombre', 'id');
        return view('articulos.create', compact('sistemas', 'definiciones', 'maquinas'));
    }

    public function store(Request $request, Articulo $articulo)
    {
        $validatedData = $request->validate([
            //'maquina' => 'nullable|exists:maquinas,id',
            //'tipo_maquina' => 'nullable|exists:maquinas,id',
            'marca' => 'nullable|string',
            'sistema' => 'nullable|string',
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
        $articulo->sistema = $validatedData['sistema'];
        $articulo->definicion = $validatedData['definicion'];
        $articulo->referencia = $validatedData['referencia'];
        $articulo->descripcionEspecifica = $validatedData['descripcion_especifica'];
        $articulo->comentarios = $validatedData['comentarios'];
        $articulo->peso = $validatedData['peso'];

        // Guardar la foto en el storage
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $rutaFoto = $request->foto->store('public/fotos');
            $articulo->fotoDescriptiva = $rutaFoto;
        }
        // Asociar las máquinas con el artículo
        $maquinas = Maquina::all();
        foreach ($maquinas as $maquina) {
            $maquina->articulos()->attach($articulo->id, ['fabricante' => $request->fabricante, 'tipo_maquina' => $request->tipo_maquina]);
        }



        $articulo->save();

        return redirect()->route('articulos.index')->with('success', 'Artículo agregado correctamente.');
    }

    public function show(Articulo $articulo, $id)
    {
        $articulo = Articulo::find($id);
        return view('articulos.show', compact('articulo'));
    }

    public function edit(Articulo $articulo, $id)
    {
        $articulo = Articulo::find($id);
        $marca = Lista::where('tipo', 'marca')->get();
        return view('articulos.edit', compact('articulo', 'marca'));
    }

    public function update(Request $request, Articulo $articulo, $id)
    {

        //buscar el articulo a actualizar
        $articulo = Articulo::find($id);
        //validar los datos del formulario
        //dd($request->all());
        $request->validate([
            'marca' => 'required',
            'sistema' => 'required',
            'definicion' => 'required',
            'referencia' => 'required',
            'comentarios' => 'nullable|string',
        ]);

        //Actualizar los datos del articulo
        $articulo->marca = $request->marca;
        $articulo->sistema = $request->sistema;
        $articulo->definicion = $request->definicion;
        $articulo->referencia = $request->referencia;
        $articulo->comentarios = $request->comentarios;

        if ($articulo->save()) {
            // redireccionar a la vista de articulos
            return redirect()->route('articulos.show', $articulo->id)->with('success', 'Articulo actualizado correctamente');
        } else {
            // en caso de error, redireccionar con un mensaje de error
            return redirect()->back()->with('error', 'Error al actualizar el artículo.');
        }
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
