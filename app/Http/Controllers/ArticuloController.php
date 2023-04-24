<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Articulo $articulo, $id)
    {
        //Validar datos del formulario
        $request->validate([
            'sistema' => 'required',
            'definicion' => 'required',
            'referencia' => 'required',
            'cantidad' => 'required',
            'comentarios' => 'required',
        ]);

        //crear un nuevo articulo
        $articulo = new Articulo();
        $articulo->sistema = $request->sistema;
        $articulo->definicion = $request->definicion;
        $articulo->referencia = $request->referencia;
        $articulo->cantidad = $request->cantidad;
        $articulo->comentarios = $request->comentarios;
        $articulo->save();

        //redireccionar a la vista de articulos
        return redirect()->route('articulos.show', $articulo->id)->with('success', 'Articulo creado correctamente');
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
    if($articulo){
        $articulo->delete();
        return redirect()->route('articulos.index')->with('success', 'Artículo eliminado correctamente');
    }else{
        return redirect()->route('articulos.index')->with('error', 'No se pudo eliminar el artículo');
    }
}

}
