<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tercero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TerceroController extends Controller
{
    public function index()
    {
        $terceros = Tercero::all();

        return view('terceros.index', compact('terceros'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $terceros = Tercero::where('nombre', 'LIKE', '%' . $query . '%')
            ->orWhere('numero_documento', 'LIKE', '%' . $query . '%')
            ->orWhere('email', 'LIKE', '%' . $query . '%')
            ->orWhere('telefono', 'LIKE', '%' . $query . '%')
            ->paginate(10);

        return response()->json($terceros);
    }


    public function create()
    {
        $paises = DB::table('paises')->get();


        return view('terceros.create', ['paises' => $paises]);
    }

    public function store(Request $request)
    {
        // 1. Obtener los datos enviados por el formulario
        $data = $request->validate([
            'rol' => ['required', 'in:cliente,proveedor'],
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20'],

            
            // ... agregar aquí todas las reglas de validación necesarias
        ]);

        // 2. Validar los datos según las reglas de validación necesarias
        // ... no hace falta hacer nada extra ya que Laravel hace esto automáticamente con el método validate

        // 3. Crear una instancia del modelo Tercero y asignar los datos validados
        $tercero = new Tercero();
        $tercero->tipo = $data['rol'];
        $tercero->nombre = $data['nombre'];
        $tercero->email = $data['email'];
        $tercero->telefono = $data['telefono'];
        // ... asignar aquí todas las propiedades del modelo

        // 4. Guardar el nuevo tercero en la base de datos
        $tercero->save();

        // 5. Redirigir al usuario a la página de detalles del nuevo tercero con un mensaje de éxito
        return redirect()->route('terceros.show', ['id' => $tercero->id])
            ->with('success', 'El tercero se ha creado exitosamente.');
    }

    public function edit(Tercero $tercero)
    {
        return view('terceros.edit', compact('tercero'));
    }

    public function update(Request $request, Tercero $tercero)
    {
        // Lógica para actualizar un tercero existente
    }

    public function destroy(Tercero $tercero)
    {
        // Lógica para eliminar un tercero existente
    }
}
