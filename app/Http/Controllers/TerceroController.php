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
            'contadorContactos' => ['integer'],


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
        $tercero->tipo_documento = $data['tipo_documento'];
        $tercero->dv = $data['dv'];
        $tercero->email_factura_electronica = $data['email_facturacion'];

        // Guardar el archivo de certificación bancaria (si se ha proporcionado uno)
        if ($request->hasFile('certificacion_bancaria')) {
            $certificacion = $request->file('certificacion_bancaria')->store('certificaciones');
            $tercero->certificacion_bancaria = $certificacion;
        }
        //guardar archivo rut
        if ($request->hasFile('rut')) {
            $rut = $request->file('rut')->storePublicly('rut', 'public');
            $tercero->rut = $rut;
        }
        $tercero->sitio_web = $data['sitioWeb'];
        //$tercero->puntos = $data['puntos'];

        // 4. Guardar el nuevo tercero en la base de datos
        $tercero->save();


        // Asociar las máquinas seleccionadas al nuevo tercero
        //si no vienen maquinas, continuar
        if ($request->has('maquinas')) {
            $maquinas_ids = $request->input('maquinas');
            $tercero->maquinas()->attach($maquinas_ids);
        }

        // dd($contadorContactos);
        // Crear los contactos del tercero
        //si no se ingresan contactos, continuar

        for ($i = 1; $i <= $data['contadorContactos']; $i++) {
            // Validar los datos del formulario del contacto
            $dataContacto = $request->validate([
                'nombre_contacto_' . $i => ['required', 'string', 'max:255'],
                'telefono_contacto_' . $i => ['nullable', 'string', 'max:20'],
                'email_contacto_' . $i => ['nullable', 'email', 'max:255'],
            ]);


            // Crear el contacto
            $contacto = new Contacto();
            $contacto->nombre = $request->{'nombre_contacto_' . $i};
            $contacto->telefono = $request->{'telefono_contacto_' . $i};
            $contacto->email = $request->{'email_contacto_' . $i};
            $contacto->save();

            // Agregar la relación a la tabla intermedia
            $tercero->contactos()->attach($contacto->id);
            // 5. Redirigir al usuario a la página de detalles del nuevo tercero con un mensaje de éxito
            return redirect()->route('terceros.show', ['id' => $tercero->id])
                ->with('success', 'El tercero se ha creado exitosamente.');
        }
        //Sincronizar los contactos asociados al tercero
        $tercero->contactos()->sync($request->contactos);
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

    public function getMaquinasByTercero($id)
    {
        $maquinas = Tercero::findOrFail($id)->maquinas;
        return response()->json($maquinas);
    }

    public function edit($id)
    {
        $tercero = Tercero::findOrFail($id);
        $paises = DB::table('pais')->get();
        $ciudades = DB::table('ciudad')->get();
        $maquinas = Maquina::allWithConcatenatedData();
        return view('terceros.edit', compact('tercero', 'paises', 'ciudades', 'maquinas', 'id'));
    }

    public function update(Request $request, Tercero $tercero, $id)
    {
        $tercero = Tercero::find($id);
        $request->validate([
            'tipo' => 'required|in:cliente,proveedor',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            //'tipo_documento' => 'required|in:cedula,nit,ce',
            //'dv' => 'nullable|string|max:1',
            'email_facturacion' => 'nullable|email|max:255',
            'sitio_web' => 'nullable|string|max:255',
            'certificacion_bancaria' => 'nullable|file|mimes:pdf|max:1024',
            'rut' => 'nullable|file|mimes:pdf|max:1024',
            'puntos' => 'nullable|integer',
            'pais_id' => 'nullable|string|max:3',
            'ciudad' => 'nullable|integer',
            'departamento_id' => 'nullable|integer',
            'codigo_postal' => 'nullable|string|max:20',
            'observaciones' => 'nullable|string|max:255',
            //          'forma_pago' => 'nullable|string|max:255',
            'maquinas' => 'nullable|array',
            'maquinas.*' => 'nullable|integer',
            'contactos' => 'nullable|array',
            'contactos.*' => 'nullable|integer',

        ]);

        $tercero->tipo = $request->tipo;
        $tercero->nombre = $request->nombre;
        $tercero->direccion = $request->direccion;
        $tercero->telefono = $request->telefono;
        $tercero->email = $request->email;
        //$tercero->tipo_documento = $request->tipo_documento;
        //$tercero->dv = $request->dv;
        $tercero->email_factura_electronica = $request->email_facturacion;
        $tercero->sitio_web = $request->sitio_web;
        $tercero->certificacion_bancaria = $request->certificacion_bancaria;
        $tercero->rut = $request->rut;
        $tercero->puntos = $request->puntos;
        $tercero->PaisCodigo = $request->pais_id;
        $tercero->CiudadID = $request->ciudad;
        $tercero->codigo_postal = $request->codigo_postal;
        $tercero->forma_pago = $request->forma_pago;
        $tercero->save();

        return redirect()->route('terceros.show', $tercero->id)->with('success', 'Tercero actualizado exitosamente');
    }

    public function preview($id)
    {
        $tercero = Tercero::findOrFail($id);
        return view('terceros.preview', compact('tercero'));
    }

    public function updateRut(Request $request, $id)
    {
        $tercero = Tercero::findOrFail($id);
        if ($request->hasFile('rut')) {
            $rut = $request->file('rut');
            $rutName = time() . '_' . $rut->getClientOriginalName();
            $rut->move(public_path('rut'), $rutName);
            $tercero->rut = $rutName;
            $tercero->save();
        }
        return redirect()->route('terceros.preview', $id);
    }



    public function destroy($id)
    {
        $tercero = Tercero::find($id);
        if ($tercero) {
            $tercero->delete();
            return redirect()->route('terceros.index')->with('success', 'Tercero eliminado correctamente');
        } else {
            return redirect()->route('terceros.index')->with('error', 'No se pudo eliminar el tercero');
        }
    }
}
