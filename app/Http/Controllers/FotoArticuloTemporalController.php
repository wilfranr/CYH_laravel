<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticuloTemporal;
use App\Models\FotoArticuloTemporal;
use Illuminate\Support\Facades\Storage;


class FotoArticuloTemporalController extends Controller
{

    public function index (ArticuloTemporal $articuloTemporal)
    {
        $fotos = $articuloTemporal->fotos;
        return view('fotos.index', compact('fotos'));
    }
    public function store(Request $request, ArticuloTemporal $articuloTemporal)
    {
        $this->validate($request, [
            'file' => 'required|image|max:2048',
        ]);

        $file = $request->file('file');

        // Guardar la foto en el sistema de archivos
        $path = $file->store('fotos');

        // Crear el registro en la tabla de fotos
        $foto = new FotoArticuloTemporal([
            'ruta' => $path,
        ]);

        // Asociar la foto al artículo temporal
        $articuloTemporal->fotos()->save($foto);

        // Redireccionar a la vista anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'La foto se ha subido correctamente.');
    }

    public function destroy(FotoArticuloTemporal $foto)
    {
        // Eliminar la foto del sistema de archivos
        Storage::delete($foto->ruta);

        // Eliminar el registro de la tabla de fotos
        $foto->delete();

        // Redireccionar a la vista anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'La foto se ha eliminado correctamente.');
    }
}

    

