@extends('layouts.app-master')

@section('content')
    <!-- Contenido principal de la plantilla -->
    <div class="container">
        <h1>Pedido #{{ $pedido->id }}</h1>
        <p>Cliente: {{ $pedido->tercero_id ? $pedido->tercero->nombre : 'N/A' }}</p>
        <p>Vendedor: {{ $pedido->user ? $pedido->user->name : 'N/A' }}</p>
        <p>Contacto: {{ $pedido->contacto ? $pedido->contacto->nombre : 'N/A' }}</p>
        
        {{-- Validar si trae teléfono, crear enlace para WhatsApp; de lo contrario, mostrar "N/A" --}}
        @if ($pedido->contacto)
            @if ($pedido->contacto->telefono)
                <p>Teléfono Contacto: <a href="https://wa.me/+57{{ $pedido->contacto->telefono }}">{{ $pedido->contacto->telefono }}</a></p>
            @else
                <p>Teléfono: N/A</p>
            @endif
        @endif

        <p>Comentario: {{ $pedido->comentario ?? 'N/A' }}</p>
        <p>Estado: {{ $pedido->estado ?? 'N/A' }}</p>

        <h2>Máquinas asociadas</h2>
        <ul>
            <!-- Mostrar el tipo de cada máquina -->
            @foreach ($pedido->maquinas as $maquina)
                <li>{{ $maquina->tipo }}</li>
            @endforeach
        </ul>

        <h2>Artículos temporales</h2>
        <!-- Mostrar información sobre los artículos temporales -->
        @foreach ($pedido->articulosTemporales as $index => $articuloTemporal)
            <div class="articulo-temporal">
                <h4>Artículo {{ $index + 1 }}</h4>
                <p>Referencia: {{ $articuloTemporal->referencia }}</p>
                <p>Definición: {{ $articuloTemporal->definicion }}</p>
                <p>Sistema: {{ $articuloTemporal->sistema }}</p>
                <p>Cantidad: {{ $articuloTemporal->cantidad }}</p>
                <p>Comentarios: {{ $articuloTemporal->comentarios }}</p>
                
                <h3>Fotos:</h3>
                <!-- Mostrar las fotos asociadas a cada artículo temporal -->
                @foreach ($articuloTemporal->fotosArticuloTemporal as $fotoArticuloTemporal)
                    <a href="{{ asset('storage/fotos-articulo-temporal/' . $fotoArticuloTemporal->foto_path) }}" target="_blank">
                        <img src="{{ asset('storage/fotos-articulo-temporal/' . $fotoArticuloTemporal->foto_path) }}" alt="Foto" width="200px">
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

