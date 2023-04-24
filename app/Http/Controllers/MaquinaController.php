<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquina;


class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maquinas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:maquinas|max:255',
            // otros campos de validación, si los hay
        ]);

        $maquina = new Maquina();
        $maquina->codigo = $request->codigo;
        // otros campos, si los hay
        $maquina->save();

        return redirect()->route('maquinas.index')->with('success', 'La máquina se ha creado correctamente.');
    }

    public function index()
{
    $maquinas = Maquina::all();
    
    return view('maquinas.index', compact('maquinas'));
}


    public function show($id)
    {
        $maquina = Maquina::find($id);
        return view('maquinas.show', compact('maquina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina, $id)
    {
        return view('maquinas.edit', compact('maquina'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maquina $maquina, $id)
    {
        //buscar la maquina a actualizar
        $maquina = Maquina::find($id);
        //validar los datos del formulario
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'serie' => 'required',
        ]);
        //actualizar los datos de la maquina
        $maquina->marca = $request->marca;
        $maquina->modelo = $request->modelo;
        $maquina->serie = $request->serie;
        $maquina->save();

        //redireccionar a la vista de maquinas
        return redirect()->route('maquinas.show', $maquina->id)->with('success', 'Maquina actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
