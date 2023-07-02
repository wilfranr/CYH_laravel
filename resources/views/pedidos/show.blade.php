@extends('adminlte::page')

@section('content')
    <!-- Contenido principal de la plantilla -->
    <div class="mt-3 mb-5">
        <h4>
            <span class="badge badge-warning"><i class="fas fa-shopping-cart"></i>Pedido #{{ $pedido->id }}</span>
            <small class="float-right">Fecha de pedido: {{ $pedido->created_at }}</small><br>
            <small class="float-right">Vendedor: {{ $pedido->user->name }}</small>
        </h4>
    </div>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <!-- info row -->
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                Datos del cliente
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-3">
                        <p>Cliente</p>
                        <h2 class="lead"><b><strong>{{ $pedido->tercero->nombre }}</strong></b></h2>
                        <p class="text-muted text-sm">
                            <b>
                                @if ($pedido->tercero->tipo_documento == 'cedula')
                                    <span class=""><i class="fas fa-lg fa-id-card"></i> CC:</span>
                                @elseif ($pedido->tercero->tipo_documento == 'nit')
                                    <span class=""><i class="fas fa-lg fa-id-card"></i> NIT:</span>
                                @elseif ($pedido->tercero->tipo_documento == 'ce')
                                    <span class=""><i class="fas fa-lg fa-id-card"></i> CE:</span>
                                @endif
                            </b> {{ $pedido->tercero->numero_documento }}
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fas fa-lg fa-building"></i> Dirección:</span>
                            </b> {{ $pedido->tercero->direccion }}
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fab fa-2x fa-whatsapp"></i> Teléfono:</span>
                            </b>
                            <a href="https://wa.me/+57{{ $pedido->tercero->telefono }}" target="_blank">
                                {{ $pedido->tercero->telefono }}

                            </a>
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fa fa-lg fa-envelope"></i> Email:</span>
                            </b>
                            <a href="mailto:{{ $pedido->tercero->email }}" target="_blank">
                                {{ $pedido->tercero->email }}

                            </a>



                        </p>
                    </div>
                    <div class="col-3">
                        <p>Contacto del cliente</p>
                        <h2 class="lead">
                            <b>
                                <strong>
                                    @if ($pedido->contacto)
                                        {{ $pedido->contacto->nombre }}
                                    @else
                                        N/A
                                    @endif
                                </strong>
                            </b>
                        </h2>

                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fab fa-2x fa-whatsapp"></i> Teléfono:</span>
                            </b>
                            @if ($pedido->contacto)
                                <a href="https://wa.me/+57{{ $pedido->contacto->telefono }}" target="_blank">
                                    {{ $pedido->contacto->telefono }}
                                @else
                                    N/A
                            @endif
                            </a>
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fa fa-lg fa-envelope"></i> Email:</span>
                            </b>
                            @if ($pedido->contacto)
                                <a href="mailto:{{ $pedido->contacto->email }}">
                                    {{ $pedido->contacto->email }}
                                </a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="col-3">
                        <p>Maquinas asociadas al pedido</p>
                        @if ($pedido->maquinas->count() > 1)
                            <h2 class="lead">
                                <b>
                                    <strong>
                                        @foreach ($pedido->maquinas as $maquina)
                                            <i class="fa fa-wrench"></i>
                                            {{ $maquina->tipo }} <a href="{{ route('maquinas.show', $maquina->id) }}"
                                                target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endforeach
                                    </strong>
                                </b>
                            </h2>


                    </div>
                    <div class="col-3 text-center">
                        <img src="{{ asset('storage/maquinas/' . $maquina->foto) }}" alt="user-avatar"
                            class="img-circle img-fluid">
                    </div>
                @else
                    N/A
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="https://wa.me/+57{{ $pedido->tercero->telefono }}" class="btn btn-sm bg-teal" target="_blank">
                        <i class="fas fa-comments"></i>
                    </a>
                    <a href="{{ route('terceros.show', $pedido->tercero->id) }}" class="btn btn-sm btn-primary"
                        target="_blank">
                        <i class="fas fa-user"></i> Ver tercero
                    </a>
                </div>
            </div>
        </div>


    </div>
    <div class="container">

        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                Artículos
            </div>
            <div class="card-body pt-0">
                <table class="table table-bordered" id="articulos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Referencia</th>
                            <th>Definición</th>
                            <th>Sistema</th>
                            <th>Cantidad</th>
                            <th>Comentarios</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->articulosTemporales as $index => $articuloTemporal)
                            <tr>
                                <td>
                                    <strong> {{ $index + 1 }}</strong>
                                </td>
                                <td>
                                    <select class="form-control select2">
                                        <option value="{{ $articuloTemporal->referencia }}">
                                            {{ $articuloTemporal->referencia }}</option>
                                        @foreach ($referencias as $referencia)
                                            <option value="{{ $referencia->referencia }}">
                                                {{ $referencia->referencia }}</option>
                                        @endforeach
                                        <!-- Agrega aquí más opciones del select si es necesario -->
                                    </select>
                                </td>

                                <td>
                                    <input type="text" class="form-control" value="{{ $articuloTemporal->definicion }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $articuloTemporal->sistema }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" value="{{ $articuloTemporal->cantidad }}">
                                </td>
                                <td>
                                    <textarea class="form-control">{{ $articuloTemporal->comentarios }}</textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success">
                                        <i class="fas fa-check"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7">
                                <button type="button" class="btn btn-outline-primary" id="addRow">
                                    Agregar artículo
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="text-right">

                    <a href="{{ route('terceros.show', $pedido->tercero->id) }}" class="btn btn-sm btn-primary"
                        target="_blank">
                        <i class="fa fa-paper-plane"></i> Enviar a costeo
                    </a>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-12">
                    <h2>Artículos reales</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Artículo</th>
                                <th>Referencia</th>
                                <th>Definición</th>
                                <th>Cantidad</th>
                                <th>Comentarios</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->articulos as $index => $articulo)
                                <tr>
                                    <td>
                                        <strong>Artículo {{ $index + 1 }}</strong>
                                        <br>
                                        <a href="{{ route('articulos.show', $articulo->id) }}"
                                            class="btn btn-sm btn-primary" target="_blank">Ver</a>
                                    </td>
                                    <td>{{ $articulo->referencia }}</td>
                                    <td>{{ $articulo->definicion }}</td>
                                    <td>{{ $articulo->pivot->cantidad }}</td>
                                    <td>{{ $articulo->comentarios }}</td>
                                    <td>
                                        <form action="{{ route('pedidos.detachArticulo', [$pedido->id, $articulo->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('pedidos.cambiarEstado', $pedido->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="tercero_id" value="{{ $pedido->tercero_id }}">

                        <input type="hidden" name="estado" value="Costeo">
                        <button type="submit" class="btn btn-primary">Enviar a Costeo</button>
                    </form>
                </div>
            </div> --}}

        </div>
    </div>

    {{-- Modal de editar articulo --}}
    <div class="modal fade" id="modalEditarArticulo" tabindex="-1" aria-labelledby="modalEditarArticuloLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarArticuloLabel">Editar artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close">
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
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-right">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearArticuloLabel">Crear artículo | Pedido # {{ $pedido->id }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @component('components.articulo-temporal-form', [
                        'articulos' => $articulos,
                        'maquinas' => $maquinas,
                        'definiciones' => $definiciones,
                        'sistemas' => $sistemas,
                        'medidas' => $medidas,
                        'unidadMedidas' => $unidadMedidas,
                        'definicionesFotoMedida' => $definicionesFotoMedida,
                        'pedido' => $pedido,
                    ])
                    @endcomponent

                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-dialog-right {
            margin-right: 0 !important;
        }
    </style>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#articulos').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
            });
            //agreagr filas
            $('#addRow').on('click', function() {
                addRow();
            });
            



            $('.select2').select2();
        });
    </script>
@endsection
