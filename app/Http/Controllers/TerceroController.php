<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tercero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pais;
use App\Models\Departamento;


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

    // public function getDepartamentos(Request $request)
    // {
    //     $departamentos = Departamento::where('pais_id', $request->pais_id)->get();
    //     return response()->json($departamentos);
    // }

    public function store(Request $request)
    {
        // 1. Obtener los datos enviados por el formulario
        $data = $request->validate([
            'tipo' => ['required', 'in:cliente,proveedor'],
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'numero_documento' => ['nullable', 'string', 'max:20'],
            'pais_id' => ['nullable', 'integer'],
            'departamento_id' => ['nullable', 'integer'],
            // 'ciudad_id' => ['nullable', 'integer'],
            //'codigo_postal' => ['nullable', 'string', 'max:20'],
            //'observaciones' => ['nullable', 'string', 'max:255'],
            'tipo_documento' => ['nullable', 'in:cedula,cedula_extranjeria,nit,nit_extranjeria,otros'],
            'dv' => ['nullable', 'string', 'max:1'],
            //'forma_pago' => ['nullable', 'string', 'max:255'],
            //'email_factura_electronica' => ['nullable', 'email', 'max:255'],
            //'rut' => ['nullable', 'string', 'max:255'],
            //'certificacion_bancaria' => ['nullable', 'string', 'max:255'],
            //'sitio_web' => ['nullable', 'string', 'max:255'],
            //'puntos' => ['nullable', 'integer'],
            
            


            // ... agregar aquí todas las reglas de validación necesarias
        ]);

        // 2. Validar los datos según las reglas de validación necesarias
        // ... no hace falta hacer nada extra ya que Laravel hace esto automáticamente con el método validate

        // 3. Crear una instancia del modelo Tercero y asignar los datos validados
        $tercero = new Tercero();
        $tercero->tipo = $data['tipo'];
        $tercero->nombre = $data['nombre'];
        $tercero->email = $data['email'];
        $tercero->telefono = $data['telefono'];
        $tercero->direccion = $data['direccion'];
        $tercero->numero_documento = $data['numero_documento'];
        $tercero->pais_id = $data['pais_id'];
        //$tercero->ciudad_id = $data['ciudad_id'];
        //$tercero->codigo_postal = $data['codigo_postal'];
        //$tercero->observaciones = $data['observaciones'];
        $tercero->tipo_documento = $data['tipo_documento'];
        $tercero->dv = $data['dv'];
        //$tercero->forma_pago = $data['forma_pago'];
        //$tercero->email_factura_electronica = $data['email_factura_electronica'];
//$tercero->rut = $data['rut'];
        //$tercero->certificacion_bancaria = $data['certificacion_bancaria'];
        //$tercero->sitio_web = $data['sitio_web'];
        //$tercero->puntos = $data['puntos'];

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
