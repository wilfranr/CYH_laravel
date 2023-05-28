@extends('layouts.app-master')
@section('title', 'Tercero')

@section('content')
    <div>
        <h1>{{ strtoupper($tercero->tipo) }}</h1>
        <h2>Razon social: {{ $tercero->nombre }}</h2>
        <p>Tipo de documento: {{ $tercero->tipo_documento }}</p>
        <p>Identificación: {{ $tercero->numero_documento }}</p>
        <p>Dirección: {{ $tercero->direccion }}</p>
        <p>Teléfono: {{ $tercero->telefono }}</p>
        <p>Email: {{ $tercero->email }}</p>
        <p>Pais: @if ($tercero->pais) {{ $tercero->pais->PaisNombre }} @endif</p>
        <p>Ciudad: @if ($tercero->ciudad) {{ $tercero->ciudad->CiudadNombre }} @endif</p>
        <p>Email Facturación: {{ $tercero->email_factura_electronica }}</p>

        <p>Sitio Web: {{ $tercero->sitio_web }}</p>
        
        <p>Certificación bancaria:
            <a href="{{ route('terceros.downloadCertificacion', ['id' => $tercero->id]) }}">Descargar</a>
        </p>

        @if ($tercero->tipo == 'cliente')
        <h3>Maquinas:</h3>
        @foreach ($tercero->maquinas as $maquina)
            <ul>
                <li>{{ $maquina->tipo }} {{ $maquina->marca }} {{ $maquina->modelo }} {{ $maquina->serie }}</li>
                <a href="https://hce-part.com/hyundai/hose/11n700030/" target="blank">Ficha tecnica</a>
            </ul>
        @endforeach
        @endif



        <h3>Contactos:</h3>
    <ul>
        @foreach ($tercero->contactos as $contacto)
            <li>{{ $contacto->nombre }} - {{ $contacto->telefono }}<a href="https://wa.me/+57{{ $contacto->telefono }}" target="blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
              </svg></a>  - <a href="mailto:{{ $contacto->elmail}}">{{ $contacto->email }}</a></li>
        @endforeach
    </ul>

    @if ($tercero->tipo == 'proveedor')
    <div class="col-md-6">
        <h4>Marcas que maneja</h4>
        <ul>
            @foreach ($tercero->marcas as $marca)
                <li>{{ $marca->nombre }}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-6">
        <h4>Sistemas que maneja</h4>
        <ul>
            @foreach ($tercero->sistemas as $sistema)
                <li>{{ $sistema->nombre }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    </div>
@endsection
