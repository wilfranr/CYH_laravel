@extends('adminlte::page')
@section('title', 'Tercero')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ strtoupper($tercero->tipo) }}</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-subtitle mb-3">Razon social: {{ $tercero->nombre }}</h5>
                    <p>Tipo de documento: {{ $tercero->tipo_documento }}</p>
                    <p>Identificación: {{ $tercero->numero_documento }}</p>
                    <p>Dirección: {{ $tercero->direccion }}</p>
                    <p>Teléfono: {{ $tercero->telefono }}</p>
                    <p>Email: {{ $tercero->email }}</p>
                    <p>Pais: @if ($tercero->pais) {{ $tercero->pais->PaisNombre }} @endif</p>
                    <p>Ciudad: @if ($tercero->ciudad) {{ $tercero->ciudad->CiudadNombre }} @endif</p>
                    <p>Email Facturación: {{ $tercero->email_factura_electronica }}</p>
                    <p>Sitio Web: {{ $tercero->sitio_web }}</p>

                    @if ($tercero->certificacion_bancaria)
                    <p>Certificación bancaria:
                        <a href="{{ route('terceros.downloadCertificacion', ['id' => $tercero->id]) }}">Descargar</a>
                    </p>
                    @endif

                    @if ($tercero->rut)
                    <p>RUT:
                        <a href="{{ route('terceros.downloadRut', ['id' => $tercero->id]) }}">Descargar</a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @if ($tercero->tipo == 'cliente')
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Maquinas</h3>
                </div>
                <div class="card-body">
                    @foreach ($tercero->maquinas as $maquina)
                    <ul class="list-group mb-3">
                        <li class="list-group-item">{{ $maquina->tipo }} {{ $maquina->marca }} {{ $maquina->modelo }} {{ $maquina->serie }}</li>
                        <a href="https://hce-part.com/hyundai/hose/11n700030/" target="_blank">Ficha técnica</a>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Contactos</h3>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($tercero->contactos as $contacto)
                <li class="list-group-item">
                    {{ $contacto->nombre }} - {{ $contacto->telefono }}
                    <a href="https://wa.me/+57{{ $contacto->telefono }}" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    -
                    <a href="mailto:{{ $contacto->elmail}}">{{ $contacto->email }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    @if ($tercero->tipo == 'proveedor')
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Marcas que maneja</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($tercero->marcas as $marca)
                        <li class="list-group-item">{{ $marca->nombre }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sistemas que maneja</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($tercero->sistemas as $sistema)
                        <li class="list-group-item">{{ $sistema->nombre }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
