<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquina;
use App\Models\Lista;



class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_maquina = Lista::where('tipo', 'Tipo Maquina')->get();
        $marca = Lista::where('tipo', 'marca')->get();
        $modelo = Lista::where('tipo', 'Modelo Maquina')->get();
        return view('maquinas.create', compact('tipo_maquina', 'marca', 'modelo'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_maquina' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'serie' => 'required',
            'arreglo' => 'required',
            'fotoMaquina' => 'nullable|image|max:2048',
            'fotoId' => 'nullable|image|max:2048',
        ]);

        $maquina = new Maquina();
        $maquina->tipo = $validatedData['tipo_maquina'];
        $maquina->marca = $validatedData['marca'];
        $maquina->modelo = $validatedData['modelo'];
        $maquina->serie = $validatedData['serie'];
        $maquina->arreglo = $validatedData['arreglo'];

        // Procesar la foto de la máquina, si se proporcionó
        if ($request->hasFile('fotoMaquina')) {
            $foto = $request->file('fotoMaquina');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $filepath = $foto->storeAs('public/maquinas', $filename);
            $maquina->foto = $filename;
        }

        // Procesar la foto del ID, si se proporcionó
        if ($request->hasFile('fotoId')) {
            $fotoId = $request->file('fotoId');
            $filename = time() . '_' . $fotoId->getClientOriginalName();
            $filepath = $fotoId->storeAs('public/maquinas', $filename);
            $maquina->foto_id = $filename;
        }

        $maquina->save();

        return redirect()->route('maquinas.index')
            ->with('success', 'La máquina ha sido creada exitosamente.');
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

    public function edit($id)
    {
        $maquina = Maquina::findOrFail($id);
        $tipo_maquina = Lista::where('tipo', 'Tipo Maquina')->get();
        $marca = Lista::where('tipo', 'marca')->get();
        $modelo = Lista::where('tipo', 'Modelo Maquina')->get();

        return view('maquinas.edit', compact('maquina', 'tipo_maquina', 'marca', 'modelo'));
    }

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

        // Procesar la foto de la máquina, si se proporcionó
        if ($request->hasFile('fotoMaquina')) {
            $foto = $request->file('fotoMaquina');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $filepath = $foto->storeAs('public/maquinas', $filename);
            $maquina->foto = $filename;
        }

        // Procesar la foto del ID, si se proporcionó
        if ($request->hasFile('fotoId')) {
            $fotoId = $request->file('fotoId');
            $filename = time() . '_' . $fotoId->getClientOriginalName();
            $filepath = $fotoId->storeAs('public/maquinas', $filename);
            $maquina->foto_id = $filename;
        }
        $maquina->save();

        //redireccionar a la vista de maquinas
        return redirect()->route('maquinas.index', $maquina->id)->with('success', 'Maquina actualizada correctamente');
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
