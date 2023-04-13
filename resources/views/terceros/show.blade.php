@extends('layouts.app-master')
@section('title', 'Tercero')

@section('content')
    <div>
        <h2>Razon social: {{ $tercero->nombre }}</h2>
        <p>Tipo de documento: {{ $tercero->tipo_documento }}</p>
        <p>Identificación: {{ $tercero->numero_documento }}</p>
        <p>Dirección: {{ $tercero->direccion }}</p>
        <p>Teléfono: {{ $tercero->telefono }}</p>
        <p>Email: {{ $tercero->email }}</p>
        <p>País: {{ $tercero->pais->PaisNombre }}</p>
        <p>Ciudad: {{ $tercero->ciudad->CiudadNombre }}</p>
        <p>Email Facturación: {{ $tercero->email_factura_electronica  }}</p>
        <p>Sitio Web: {{ $tercero->sitio_web }}</p>
        <p>Certificación bancaria: <a href="{{ route('terceros.downloadCertificacion', ['id' => $tercero->id]) }}">Descargar</a></p>




        <hr>
        {{-- <h3>Contactos:</h3>
    <ul>
        @foreach ($contactos as $contacto)
            <li>{{ $contacto->nombre }} - {{ $contacto->telefono }}</li>
        @endforeach
    </ul> --}}
    </div>
@endsection
