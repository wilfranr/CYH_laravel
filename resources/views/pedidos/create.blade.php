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
                        <input type="text" name="telefono" id="telefono" class="form-control" value="" readonly>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="maquina_id">Máquina:</label>
                            <select name="maquina_id" id="maquina_id" class="form-control">
                            </select>
                        </div>

                    </div>
                </div>
                <form method="POST" action="" id="formulario-articulo">
                    @csrf
                    <div class="row">
                        <h2>Detalle</h2>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sistema">Sistema</label>
                                <select name="sistema" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($sistemas as $id => $nombre)
                                        <option value="{{ $id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comentarios">Comentarios</label>
                                <textarea name="comentarios" id="comentarios" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <label for="referencia">Referencia</label>
                                <input type="text" name="referencia" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="definicion">Definición</label>
                                <textarea name="definicion" id="definicion" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="foto">Foto</label>
                                <input type="file" name="fotos[]" multiple>
                            </div>
                            <button id="boton-agregar-articulo" type="button">Agregar artículo</button>

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


        </form>

        {{-- Modal de clientes --}}
        <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="modalClientesLabel" aria-hidden="true">
            <div class="modal-dialog">
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
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary seleccionar-cliente"
                                                data-id="{{ $tercero->id }}" data-nombre="{{ $tercero->nombre }}"
                                                data-identificacion="{{ $tercero->numero_documento }}"
                                                data-direccion="{{ $tercero->direccion }}"
                                                data-telefono="{{ $tercero->telefono }}" data-dismiss="modal"
                                                data-bs-dismiss="modal">Seleccionar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                cargarMaquinas();



            });
            // $(document).ready(function() {
            //     $('#cliente_id').change(function() {
            //         cargarMaquinas();
            //     });
            // });
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
        });
        $('#boton-agregar-articulo').click(function() {
    // obtener los valores del formulario
    var sistema = $('#sistema').inner
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
            '<button type="button" class="boton-editar-articulo">Editar</button>' +
            '<button type="button" class="boton-eliminar-articulo">Eliminar</button>' +
        '</td>' +
    '</tr>';

    // agregar la fila a la tabla
    $('#tabla-articulos tbody').append(fila);

    // limpiar los campos del formulario
    $('#sistema').val('');
    $('#definicion').val('');
    $('#referencia').val('');
    $('#cantidad').val();
    $('#comentarios').val('');
});

        
    </script>
@endsection
