<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lista;
use App\Models\Maquina;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::all();
        
        return view('articulos.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maquinas = Maquina::all();
        $sistemas = Lista::where('tipo', 'sistema')->pluck('nombre', 'id');
        $definiciones = Lista::where('tipo', 'Descripción común')->pluck('nombre', 'id');
        return view('articulos.create', compact('sistemas', 'definiciones', 'maquinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Articulo $articulo)
    {
        $validatedData = $request->validate([
            //'maquina' => 'nullable|exists:maquinas,id',
            //'tipo_maquina' => 'nullable|exists:maquinas,id',
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
        $articulo->sistema = $validatedData['sistema'];
        $articulo->definicion = $validatedData['definicion'];
        $articulo->referencia = $validatedData['referencia'];
        $articulo->descripcionEspecifica = $validatedData['descripcion_especifica'];
        $articulo->comentarios = $validatedData['comentarios'];
        $articulo->peso = $validatedData['peso'];

        // Guardar la foto en el storage
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $rutaFoto = $request->foto->store('public/fotos');
            $articulo->ruta_foto = $rutaFoto;
        }
        // Asociar las máquinas con el artículo
        $maquinasIds = $request->input('maquinas', []);
        $articulo->maquinas()->sync($maquinasIds);

        $articulo->save();

        return redirect()->route('articulos.index')->with('success', 'Artículo agregado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo, $id)
    {
        $articulo = Articulo::find($id);
        return view('articulos.show', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo, $id)
    {
        $articulo = Articulo::find($id);
        return view('articulos.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo, $id)
    {

        //buscar el articulo a actualizar
        $articulo = Articulo::find($id);
        //validar los datos del formulario
        $request->validate([
            'sistema' => 'required',
            'definicion' => 'required',
            'referencia' => 'required',
            'cantidad' => 'required',
            'comentarios' => 'required',
        ]);

        //Actualizar los datos del articulo
        $articulo->sistema = $request->sistema;
        $articulo->definicion = $request->definicion;
        $articulo->referencia = $request->referencia;
        $articulo->cantidad = $request->cantidad;
        $articulo->comentarios = $request->comentarios;
        $articulo->save();

        //redireccionar a la vista de articulos
        return redirect()->route('articulos.show', $articulo->id)->with('success', 'Articulo actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
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
