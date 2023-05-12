@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Pedido # {{ $ultimoPedido }}</h1>
        <form action="" method="post">
            @csrf
            <div class="form-group">
                {{-- boton para buscar cliente --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalClientes">
                    Buscar cliente
                </button>
                {{-- dirigir a crear tercero --}}
                <a href="{{ route('terceros.create') }}" class="btn btn-primary" target="blank">Agregar cliente</a>
            </div>
            <div class="row">


                {{-- Bloque izquierdo --}}
                <div class="col-md-6">

                    <div class="form-group">
                        {{-- mostrar cliente seleccionado --}}
                        <div class="form-group">
                            <label for="cliente_id">Cliente</label>
                            <input type="hidden" name="cliente_id" id="cliente_id" value="">
                            <input type="text" class="form-control" id="cliente_nombre" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="" readonly>
                    </div>

                </div>


                {{-- Bloque derecho --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_documento">No. Documento</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control"
                            value="" readonly>
                        <input type="hidden" name="puntos" value="">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="" readonly><a
                            href="" id="wp_cliente" target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-whatsapp"
                                viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg></a>
                    </div>
                    <div class="form-group">
                        <label for="contactoTercero">Contacto</label>
                        <select name="contactoTercero" id="contactoTercero" class="form-select">
                            <option value="">Seleccione</option>

                        </select>
                        <div id="divContactoTercero">
                            <a href="" id="wp_contacto" target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-whatsapp"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg></a>
                        </div>
                    </div>

                </div>
                <div class="row" id="maquina">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="maquina_id">Máquina:</label>
                            <select name="maquina_id[]" id="maquina_id" class="form-select" multiple="multiple">
                                @foreach ($maquinas as $id => $maquina)
                                    <option value="{{ $id }}">{{ $maquina->tipo }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>
                </div>
                <form method="POST" action="" id="formulario-articulo">
                    @csrf
                    <div class="row" id="div-detalle">
                        <h2>Detalle</h2>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="referencia">Referencia</label>
                                <select name="referencia" id="referencia" class="form-select">
                                    <option value="">Seleccione</option>
                                    @foreach ($articulos as $id => $articulo)
                                        <option value="{{ $articulo->id }}">{{ $articulo->referencia }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sistema">Sistema</label>
                                <select name="sistema" class="form-select" id="sistema">
                                    <option value="">Seleccione</option>
                                    @foreach ($sistemas as $id => $nombre)
                                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comentarios">Comentarios</label>
                                <textarea name="comentarios" id="comentarios" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="definicion">Definición</label>
                                <input type="text" name="definicion" id="definicion" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" id="cantidad" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="foto">Foto</label>
                                <input type="file" name="fotos[]" multiple class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-primary mb-5" id="boton-agregar-articulo" type="button">Agregar
                                    artículo</button>
                            </div>
                        </div>
                    </div>


                </form>


            </div>


    </div>

    <div class="container">
        <table id="tabla-articulos">
            <thead>
                <tr>
                    <th>Sistema</th>
                    <th>Definición</th>
                    <th>Referencia</th>
                    <th>Cantidad</th>
                    <th>Comentarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irán las filas de los artículos -->
            </tbody>
        </table>
    </div>


    {{-- Modal de clientes --}}
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="modalClientesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalClientesLabel">Buscar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Buscar">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>No. Documento</th>
                                <th>direccion</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Terceros as $tercero)
                                <tr>
                                    <td>{{ $tercero->id }}</td>
                                    <td>{{ $tercero->nombre }}</td>
                                    <td>{{ $tercero->numero_documento }}</td>
                                    <td>{{ $tercero->direccion }}</td>
                                    <td>{{ $tercero->telefono }}</td>
                                    <td>{{ $tercero->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary seleccionar-cliente"
                                            data-id="{{ $tercero->id }}" data-nombre="{{ $tercero->nombre }}"
                                            data-identificacion="{{ $tercero->numero_documento }}"
                                            data-direccion="{{ $tercero->direccion }}"
                                            data-telefono="{{ $tercero->telefono }}" data-email="{{ $tercero->email }}"
                                            data-dismiss="modal" data-bs-dismiss="modal">Seleccionar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        //busqueda dinámica en tabla terceros
        $(document).ready(function() {
            //ocultar div maquina
            $('#maquina').hide();
            // Capturar el evento de clic en el botón "Seleccionar" de la tabla de clientes
            $(document).on('click', '.seleccionar-cliente', function() {
                //mostrar div maquina
                $('#maquina').show();
                // Cerramos el modal
                $('#modalClientes').modal('hide');
                // Actualizar los datos del formulario de crear pedido con los datos del cliente seleccionado
                $('#cliente_id').val($(this).data('id'));
                $('#cliente_nombre').val($(this).data('nombre'));
                $('#numero_documento').val($(this).data('identificacion'));
                $('#direccion').val($(this).data('direccion'));
                $('#telefono').val($(this).data('telefono'));
                $('#wp_cliente').attr('href', 'https://wa.me/' + $(this).data('telefono'));
                $('#wp_contacto').attr('href', 'https://wa.me/' + $(this).data('telefono'));

                $('#email').val($(this).data('email'));
                cargarMaquinas();
                cargarContactos();
            });

            //cargar maquinas
            function cargarMaquinas() {
                // Obtener el valor del ID del tercero seleccionado
                var tercero_id = $('#cliente_id').val();

                // Hacer una petición AJAX al servidor para obtener las maquinas del tercero
                $.ajax({
                    type: "GET",
                    url: "/terceros/" + tercero_id + "/maquinas",
                    success: function(data) {
                        console.log(data);
                        $('#maquina_id').empty();
                        $.each(data, function(index, maquina) {
                            $('#maquina_id').append($('<option>', {
                                value: maquina.id,
                                text: maquina.marca + ' ' + maquina.modelo + ' ' +
                                    maquina.serie + ' ' + maquina.arreglo
                            }));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });

            }




            // Capturar el evento de cambio en el campo de búsqueda de clientes
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#modalClientes tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            //select2
            $('.form-select').select2({
                placeholder: "Seleccione una opción",
                allowClear: true
            });

            //cargar contactos de tercero
            function cargarContactos() {
                // Obtener el valor del ID del tercero seleccionado
                var tercero_id = $('#cliente_id').val();

                // Hacer una petición AJAX al servidor para obtener las maquinas del tercero
                $.ajax({
                    type: "GET",
                    url: "/terceros/" + tercero_id + "/contactos",
                    success: function(data) {
                        console.log(data);
                        $('#contactoTercero').empty();
                        $.each(data, function(index, contacto) {
                            $('#contactoTercero').append($('<option>', {
                                value: contacto.id,
                                text: contacto.nombre + ' ' + contacto.telefono
                            }));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });

            }

            // traer datos de referencia si se selecciona una
            $('#referencia').change(function() {
                var referencia = $('#referencia').val();
                $.ajax({
                    type: "GET",
                    url: "/articulos/" + referencia,
                    success: function(data) {
                        console.log(data);
                        $('#sistema').val(data.sistema);
                        $('#definicion').val(data.definicion);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
        if ($('#cantidad').val() == '') {
            $('#cantidad').val(1);

        }
        $('#boton-agregar-articulo').click(function() {
            // obtener los valores del formulario
            var sistema = $('#sistema').val();
            var definicion = $('#definicion').val();
            var referencia = $('#referencia').val();
            var cantidad = $('#cantidad').val();
            var comentarios = $('#comentarios').val();

            // crear la fila de la tabla
            var fila = '<tr>' +
                '<td>' + sistema + '</td>' +
                '<td>' + definicion + '</td>' +
                '<td>' + referencia + '</td>' +
                '<td>' + cantidad + '</td>' +
                '<td>' + comentarios + '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-danger">X</button>' +
                '</td>' +
                '</tr>';

            // agregar la fila a la tabla
            $('#tabla-articulos tbody').append(fila);

            // limpiar los campos del formulario
            $('#sistema').val(null).trigger('change');
            $('#definicion').val('');
            $('#referencia').val(null).trigger('change');
            $('#cantidad').val(1);
            $('#comentarios').val('');

        });
    </script>
@endsection
