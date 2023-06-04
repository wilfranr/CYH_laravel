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
                <p>Teléfono Contacto: <a
                        href="https://wa.me/+57{{ $pedido->contacto->telefono }}">{{ $pedido->contacto->telefono }}</a></p>
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
                @if ($articuloTemporal->referencia)
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#modalEditarArticulo">
                        Editar artículo
                    </button>
                @else
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#modalCrearArticulo">
                        Crear artículo
                    </button>
                @endif
                <p>Referencia: {{ $articuloTemporal->referencia }}</p>
                <p>Definición: {{ $articuloTemporal->definicion }}</p>
                <p>Sistema: {{ $articuloTemporal->sistema }}</p>
                <p>Cantidad: {{ $articuloTemporal->cantidad }}</p>
                <p>Comentarios: {{ $articuloTemporal->comentarios }}</p>

                <h3>Fotos:</h3>
                <!-- Mostrar las fotos asociadas a cada artículo temporal -->
                @foreach ($articuloTemporal->fotosArticuloTemporal as $fotoArticuloTemporal)
                    <a href="{{ asset('storage/fotos-articulo-temporal/' . $fotoArticuloTemporal->foto_path) }}"
                        target="_blank">
                        <img src="{{ asset('storage/fotos-articulo-temporal/' . $fotoArticuloTemporal->foto_path) }}"
                            alt="Foto" width="200px">
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>


    {{-- Modal de editar articulo --}}
    <div class="modal fade" id="modalEditarArticulo" tabindex="-1" aria-labelledby="modalEditarArticuloLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarArticuloLabel">Editar artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Acá se va a editar el articulo</p>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de crear articulo --}}
    <div class="modal fade" id="modalCrearArticulo" tabindex="-1" aria-labelledby="modalCrearArticuloLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearArticuloLabel">Crear artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @component('components.articulo-temporal-form', ['articulos' => $articulos, 'maquinas' => $maquinas, 'definiciones' => $definiciones, 'sistemas' => $sistemas, 'medidas' => $medidas, 'unidadMedidas' => $unidadMedidas, 'definicionesFotoMedida' => $definicionesFotoMedida  ])
                    @endcomponent

                </div>
            </div>
        </div>
    </div>

@endsection
