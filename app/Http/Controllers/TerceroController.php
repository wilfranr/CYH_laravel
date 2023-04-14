<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tercero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Maquina;
use App\Models\Contacto;


use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Ciudad;



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


        $paises = DB::table('pais')->get();
        $ciudades = DB::table('ciudad')->get();
        $maquinas = Maquina::allWithConcatenatedData();




        return view('terceros.create')->with('paises', $paises)->with('ciudad', $ciudades)->with('maquinas', $maquinas);
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
            'pais_id' => ['nullable', 'string', 'max:3'],
            // 'departamento_id' => ['nullable', 'integer'],
            'ciudad' => ['nullable', 'integer'],
            // 'codigo_postal' => ['nullable', 'string', 'max:20'],
            //'observaciones' => ['nullable', 'string', 'max:255'],
            'tipo_documento' => ['required', 'in:cedula,nit,ce'],
            'dv' => ['nullable', 'string', 'max:1'],
            //'forma_pago' => ['nullable', 'string', 'max:255'],
            'email_facturacion' => ['nullable', 'email', 'max:255'],
            'rut' => ['nullable', 'file', 'mimes:pdf', 'max:1024'],
            'certificacion_bancaria' => ['nullable', 'file', 'mimes:pdf', 'max:1024'],
            'sitioWeb' => ['nullable', 'string', 'max:255'],
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
        $tercero->PaisCodigo = $data['pais_id'];
        if (isset($data['ciudad'])) {
            $tercero->CiudadID = $data['ciudad'];
        }

        // $tercero->codigo_postal = $data['codigo_postal'];
        //$tercero->observaciones = $data['observaciones'];
        $tercero->tipo_documento = $data['tipo_documento'];
        $tercero->dv = $data['dv'];
        //$tercero->forma_pago = $data['forma_pago'];
        $tercero->email_factura_electronica = $data['email_facturacion'];
        //$tercero->rut = $data['rut'];
        // Guardar el archivo de certificación bancaria (si se ha proporcionado uno)
        if ($request->hasFile('certificacion_bancaria')) {
            $certificacion = $request->file('certificacion_bancaria')->store('certificaciones');
            $tercero->certificacion_bancaria = $certificacion;
        }
        //guardar archivo rut
        if ($request->hasFile('rut')) {
            $rut = $request->file('rut')->store('rut');
            $tercero->rut = $rut;
        }
        $tercero->sitio_web = $data['sitioWeb'];
        //$tercero->puntos = $data['puntos'];

        // ... asignar aquí todas las propiedades del modelo

        // 4. Guardar el nuevo tercero en la base de datos
        $tercero->save();
        // Si se ha seleccionado alguna máquina, asociarla al tercero
        // Asociar las máquinas seleccionadas al nuevo tercero
        $maquinas_ids = $request->input('maquinas');
        $tercero->maquinas()->attach($maquinas_ids);

        foreach ($request->contactos as $contacto) {
            $contactoTercero = new Contacto;
            $contactoTercero->nombre = $contacto['nombre'];
            $contactoTercero->email = $contacto['email'];
            $contactoTercero->telefono = $contacto['telefono'];
            $contactoTercero->save();

            $tercero->contactos()->attach($contactoTercero->id);
        }

        // 5. Redirigir al usuario a la página de detalles del nuevo tercero con un mensaje de éxito
        return redirect()->route('terceros.show', ['id' => $tercero->id])
            ->with('success', 'El tercero se ha creado exitosamente.');
    }



    public function show($id)
    {
        $tercero = Tercero::findOrFail($id);
        return view('terceros.show', compact('tercero'));
    }

    public function downloadCertificacion($id)
    {
        $tercero = Tercero::findOrFail($id);
        $pathToFile = storage_path('app/' . $tercero->certificacion_bancaria);
        return response()->download($pathToFile);
    }

    // public function show($id)
    // {
    //     $tercero = Tercero::findOrFail($id);
    //     $contactos = $tercero->contactos;

    //     return view('terceros.show', compact('tercero', 'contactos'));
    // }


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
