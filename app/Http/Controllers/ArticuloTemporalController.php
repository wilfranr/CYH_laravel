<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoArticuloTemporal;


class ArticuloTemporalController extends Controller
{
    // ...

    public function subirFotos(Request $request)
    {
        $file = $request->file('file');
        $nombreArchivo = $file->getClientOriginalName();
        $rutaArchivo = $file->store('fotos-articulos-temporales');

        // Crear una nueva instancia de FotoArticuloTemporal
        $foto = new FotoArticuloTemporal();
        $foto->articulo_temporal_id = $request->articulo_id;
        $foto->ruta = $rutaArchivo;
        $foto->nombre = $nombreArchivo;
        $foto->save();

        return response()->json(['success' => true]);
    }

    public function eliminarFoto(Request $request)
    {
        $foto = FotoArticuloTemporal::findOrFail($request->id);

        // Eliminar el archivo del almacenamiento
        Storage::delete($foto->ruta);

        // Eliminar la fila de la tabla fotos_articulo_temporal
        $foto->delete();

        return response()->json(['success' => true]);
    }

    // ...
}

