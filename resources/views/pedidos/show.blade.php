@extends('adminlte::page')

@section('content')
    {{-- <style>
        #chat-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        #chat-box {
            display: none;
        }
    </style>
    <div id="chat-container">
        <button id="chat-toggle" class="btn btn-info"><i class=" fa fa-comments"></i> </button>
        <div id="chat-box" class="card">
            <div class="card-header">
                Chat
            </div>
            <div class="card-body">
                <!-- Aquí puedes agregar el contenido del chat -->
                <p>Bienvenido al chat. ¡Hazme una pregunta!</p>
            </div>
        </div>
    </div> --}}
    <!-- Contenido principal de Pedido -->
    <div class="mt-3 mb-5">
        <h4>
            <span class="badge badge-warning"><i class="fas fa-shopping-cart"></i>Pedido #{{ $pedido->id }}</span>
            <small class="float-right">Fecha de pedido: {{ $pedido->created_at }}</small><br>
            <small class="float-right">Vendedor: {{ $pedido->user->name }}<a href="">
                    <i class="fas fa-comments"></i>
                </a></small>
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


        <!-- info pedido -->
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
                        @if ($pedido->maquinas->count() >= 1)
                            <h2 class="lead">
                                <strong>
                                    @foreach ($pedido->maquinas as $maquina)
                                        <ul>
                                            <li>
                                                <b>
                                                    <i class="fa fa-wrench"></i>
                                                    {{ $maquina->tipo }} <a
                                                        href="{{ route('maquinas.show', $maquina->id) }}" target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a><br>
                                                </b>
                                                <p>{{ $maquina->marca }}</p>
                                                <p>{{ $maquina->modelo }}</p>


                                            </li>
                                        </ul>
                                    @endforeach
                                </strong>

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
                <div>
                    Comentarios del pedido: <br>
                    <textarea class="form-control" disabled>{{ $pedido->comentario }}</textarea>

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

        {{-- Tabla con artículos --}}
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                Artículos
            </div>
            <div class="card-body pt-0">
                <table id="articulos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 35%;">Referencia--Definición</th>
                            <th style="width: 10%;">Cantidad</th>
                            <th style="width: 30%;">Comentarios</th>
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
                                    <div class="d-flex">
                                      <select class="form-control select2" style="width: 100%;" id="referencia">
                                        <option value="{{ $articuloTemporal->referencia }}">
                                          {{ $articuloTemporal->referencia }}--{{ $articuloTemporal->definicion }}
                                        </option>
                                        @foreach ($referencias as $referencia)
                                          <option value="{{ $referencia->referencia }}">
                                            {{ $referencia->referencia }}--{{ $referencia->definicion }}
                                          </option>
                                        @endforeach
                                        <!-- Agrega aquí más opciones del select si es necesario -->
                                      </select>
                                      <button class="btn btn-sm btn-outline-primary ml-2" type="button" onclick="agregarReferencia()">
                                        <i class="fas fa-plus"></i>
                                      </button>
                                    </div>
                                    <div id="agregarReferencia">
<input type="text" class="form-control" placeholder="referencia" id="referencia" name="referencia" value="">
                                    </div>
                                  </td>
                                  
                                <td>
                                    <input type="number" class="form-control" value="{{ $articuloTemporal->cantidad }}"
                                        style="width: 100px;">
                                </td>
                                <td>
                                    <textarea class="form-control" disabled>{{ $articuloTemporal->comentarios }}</textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger delete-row-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                

                <div class="d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-primary" id="addRow">
                            <i class="fas fa-plus"></i>
                            Agregar artículo
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('articulos.create') }}" class="btn btn-outline-success" id="crearArticuloBtn">
                            <i class="fas fa-cube"></i>
                            Crear artículo nuevo
                        </a>
                    </div>
                </div>



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
    {{-- <div class="modal fade" id="modalEditarArticulo" tabindex="-1" aria-labelledby="modalEditarArticuloLabel"
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
    </div> --}}

    {{-- Modal de crear articulo --}}
    {{-- <div class="modal fade" id="modalCrearArticulo" tabindex="-1" aria-labelledby="modalCrearArticuloLabel"
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
    </div> --}}

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#chat-toggle').click(function() {
                $('#chat-box').slideToggle();
            });
            var contador = 1;
            // Evento click para agregar una nueva fila
            $(document).on('click', '#addRow', function() {
                contador++;
                var fila = '<tr>' +
                    '<td><strong>' + contador + '</strong></td>' +
                    '<td>' +
                    '<select class="form-control select2" style="width: 100%;" id="referencia">' +
                    '<option value="">Seleccione una referencia</option>' +
                    '@foreach ($referencias as $referencia)' +
                    '<option value="{{ $referencia->referencia }}">' +
                    '{{ $referencia->referencia }}--{{ $referencia->definicion }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="number" class="form-control" value="1" style="width: 100px;">' +
                    '</td>' +
                    '<td>' +
                    '<textarea class="form-control" disabled></textarea>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-outline-danger delete-row-btn">' +
                    '<i class="fas fa-trash"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>';
                $('#articulos tbody').append(fila);
                $('.select2').select2();
            });
            //ocultar div agregar referencia
            $('#agregarReferencia').hide();

        });

        // Evento change para eliminar fila
        $(document).on('click', '.delete-row-btn', function() {
            $(this).closest('tr').remove();
        });
        //mostrar div agregar referencia
        function agregarReferencia() {
            $('#agregarReferencia').show();
        }
    </script>
@endsection
