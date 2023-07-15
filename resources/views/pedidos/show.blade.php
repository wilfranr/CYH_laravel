@extends('adminlte::page')

@section('content')

    <!-- Contenido principal de Pedido -->
    <div class="mt-3 mb-5">
        <h4>
            <span class="badge badge-warning"><i class="fas fa-shopping-cart"></i>Pedido #{{ $pedido->id }}</span>
            <small class="float-right">Fecha de pedido: {{ $pedido->created_at }}</small><br>
            <small class="float-right">Vendedor: {{ $pedido->user->name }} <a
                    href="https://wa.me/+57{{ $pedido->user->phone }}" target="_blank"><i
                        class="fab fa-whatsapp"></i></a></small><br>

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

        <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- info pedido -->
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    Datos del cliente
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-3">
                            <p>Cliente</p>
                            <input type="hidden" name="tercero_id" id="tercero_id" value="{{ $pedido->tercero->id }}"
                                readonly>
                            <input type="hidden" name="user_id" id="user_id" value="{{ $pedido->user->id }}">
                            <input type="hidden" name="estado" id="estado" value="Costeo">
                            <input type="hidden" name="comentario" id="comentario" value="{{ $pedido->comentario }}">
                            <input type="hidden" name="contacto_id" id="contacto_id" value="{{ $pedido->contacto->id }}">
                            <input type="hidden" name="maquina_id" id="maquina_id"
                                value="{{ $pedido->maquinas->first()->id }}">
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
                                                            href="{{ route('maquinas.show', $maquina->id) }}"
                                                            target="_blank">
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
                        <a href="https://wa.me/+57{{ $pedido->tercero->telefono }}" class="btn btn-sm bg-teal"
                            target="_blank">
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
                            <th style="width: 3%">#</th>
                            <th style="width: 35%;">Referencia--Definición</th>
                            <th style="width: 10%;">Cantidad</th>
                            <th style="width: 30%;">Comentarios</th>

                            <th style="width: 10%;">Imágen</th>

                            <th style="width: 3%;"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pedido->articulosTemporales as $index => $articuloTemporal)
                            <tr>
                                <td>
                                    <strong>{{ $index + 1 }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <select class="form-control select2" style="width: 100%;"
                                            name="referencia{{ $index + 1 }}">
                                            <option value="{{ $articuloTemporal->referencia }}">
                                                {{ $articuloTemporal->referencia }}--{{ $articuloTemporal->definicion }}
                                            </option>
                                            @foreach ($referencias as $referencia)
                                                <option value="{{ $referencia->referencia }}">
                                                    {{ $referencia->referencia }}--{{ $referencia->definicion }}
                                                </option>
                                                @endforeach
                                                <input type="hidden" value="{{ $articuloTemporal->definicion }}" name="definicion{{ $index + 1 }}">
                                            <!-- Agrega aquí más opciones del select si es necesario -->
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="cantidad{{ $index + 1 }}"
                                        value="{{ $articuloTemporal->cantidad }}" style="width: 100px;">
                                </td>
                                <td>
                                    <textarea class="form-control" name="comentarios{{ $index + 1 }}" disabled>{{ $articuloTemporal->comentarios }}</textarea>
                                </td>
                                <!-- Aca va la foto del articulo temporal -->
                                @if ($articuloTemporal->fotosArticuloTemporal->count() > 0)
                                    <td>
                                        <a href="{{ asset('storage/fotos-articulo-temporal/' . $articuloTemporal->fotosArticuloTemporal->first()->foto_path) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/fotos-articulo-temporal/' . $articuloTemporal->fotosArticuloTemporal->first()->foto_path) }}"
                                                alt="Foto del artículo" width="50px">
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <img src="{{ asset('storage/fotos-articulo-temporal/no-imagen.jpg') }}"
                                            alt="Foto del artículo" width="50px">
                                    </td>
                                @endif
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
                        <a href="{{ route('articulos.create') }}" class="btn btn-outline-success" id="crearArticuloBtn"
                            target="_blank">
                            <i class="fas fa-cube"></i>
                            Crear artículo nuevo
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">

                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fa fa-paper-plane"></i> Enviar a costeo
                </button>

            </div>
        </div>

    </div>
    <input type="hidden" name="articulos-temporales" value="{{ $pedido->articulosTemporales->count() }}">

    </form>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#chat-toggle').click(function() {
                $('#chat-box').slideToggle();
            });
            var contador = 0;
            // Evento click para agregar una nueva fila
            $(document).on('click', '#addRow', function() {
                $('#agregarReferencia').hide();
                contador++;
                var fila = '<tr>' +
                    '<td><strong>' + contador + '</strong></td>' +
                    '<td>' +
                    '<div class="d-flex">' +
                    '<select class="form-control select2" style="width: 100%;" id="referencia">' +
                    '<option value="">Seleccione una referencia</option>' +
                    '@foreach ($referencias as $referencia)' +
                    '<option value="{{ $referencia->referencia }}">' +
                    '{{ $referencia->referencia }}--{{ $referencia->definicion }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +

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
