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

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $rutaFoto = $foto->store('public/fotos');
            $lista->foto = $rutaFoto;
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


    public function update(Request $request, $id)
    {
        $lista = Lista::findOrFail($id);
        $request->validate([
            'tipo' => 'required',
            'nombre' => 'required',
            'definicion' => 'required',
            'foto' => 'image|nullable'
        ]);

        $lista->tipo = $request->tipo;
        $lista->nombre = $request->nombre;
        $lista->definicion = $request->definicion;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $rutaFoto = $foto->store('public/fotos');
            $lista->foto = $rutaFoto;
        }

        $lista->save();

        return redirect()->route('listas.index')->with('success', 'La lista ha sido actualizada exitosamente.');
    }

    public function destroy(Lista $lista)
    {
        $lista->delete();

        return redirect()->route('listas.index')->with('success', 'La lista ha sido eliminada exitosamente.');
    }
}
