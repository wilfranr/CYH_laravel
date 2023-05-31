<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;
use App\Models\ListaPadre;


class ListaController extends Controller
{
    public function index()
    {
        $listas = Lista::all();
        return view('listas.index', compact('listas'));
    }

    public function create()
    {
        $listasPadre = ListaPadre::all();
        return view('listas.create', compact('listasPadre'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'nombre' => 'required',
            'definicion' => 'required',
            'foto' => 'image|nullable'
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
        }else{
            $lista->foto = 'no-imagen.jpg';
        }

        // Procesar la foto de la medida si se proporcionó
        if ($request->hasFile('fotoMedida')) {
            $foto = $request->file('fotoMedida');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $filepath = $foto->storeAs('public/listas', $filename);
            $lista->fotoMedida = $filename;
        }else{
            $lista->fotoMedida = 'no-imagen.jpg';
        }

        $lista->save();

        return redirect()->route('listas.index')->with('success', 'La lista ha sido creada exitosamente.');
    }

    public function show($id)
    {
        $lista = Lista::findOrFail($id);
        return view('listas.show', compact('lista'));
    }


    public function edit($id)
{
    $lista = Lista::findOrFail($id);
    $listasPadre = ListaPadre::all();
    return view('listas.edit', compact('lista', 'listasPadre'));
}


    public function update(Request $request, Lista $lista, $id)
    {
        $lista = Lista::findOrFail($id);
        $request->validate([
            'tipo' => 'required',
            'nombre' => 'required',
            'definicion' => 'required'
        ]);

        $lista->tipo = $request->tipo;
        $lista->nombre = $request->nombre;
        $lista->definicion = $request->definicion;

        // Procesar la foto de la lista, si se proporcionó
        if ($request->hasFile('fotoLista')) {
            $foto = $request->file('fotoLista');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $filepath = $foto->storeAs('public/listas', $filename);
            $lista->foto = $filename;
        }else{
            $lista->foto = 'no-imagen.jpg';
        }

        $lista->save();

        return redirect()->route('listas.index')->with('success', 'La lista ha sido actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $lista = Lista::findOrFail($id);
        if ($lista) {
            $lista->delete();
            return redirect()->route('listas.index')->with('success', 'La lista ha sido eliminada exitosamente.');
        }else{
            return redirect()->route('listas.index')->with('error', 'La lista no pudo ser eliminada.');
        }
    }
}
