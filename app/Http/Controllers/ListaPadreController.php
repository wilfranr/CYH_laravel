<?php

namespace App\Http\Controllers;

use App\Models\ListaPadre;
use App\Http\Requests\StoreListaPadreRequest;
use App\Http\Requests\UpdateListaPadreRequest;

class ListaPadreController extends Controller
{
    public function index()
    {
        $listasPadre = ListaPadre::all();
        return view('listasPadre.index', compact('listasPadre'));
    }

    public function create()
    {
        return view('listasPadre.create');
    }

    public function store(StoreListaPadreRequest $request)
    {
        $listasPadre = new ListaPadre();
        $listasPadre->nombre = $request->nombre;
        $listasPadre->save();
        return redirect()->route('listasPadre.index');
    }

    public function edit(ListaPadre $listaPadre)
    {
        return view('listasPadre.edit', compact('listaPadre'));
    }

    public function update(UpdateListaPadreRequest $request, ListaPadre $listaPadre)
    {
        $listaPadre->nombre = $request->nombre;
        $listaPadre->save();
        return redirect()->route('listasPadre.index');
    }
    public function destroy(ListaPadre $listaPadre)
    {
        $listaPadre->delete();
        return redirect()->route('listasPadre.index');
    }
}
