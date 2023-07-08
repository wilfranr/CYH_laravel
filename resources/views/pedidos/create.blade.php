@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Pedido # {{ $ultimoPedido }}</h1>
        <form action="{{ route('pedidos.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                {{-- boton para buscar cliente --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalClientes">
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
                            <label for="tercero_id">Cliente</label>
                            <input type="hidden" name="tercero_id" id="tercero_id" value="" required>
                            <input type="text" class="form-control" id="cliente_nombre" value="" readonly required>
                            <input for="estado" type="hidden" name="estado" value="Nuevo">
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
                            href="" id="wp_contacto" target="_blank"><i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="contactoTercero">Contacto</label>
                        <select name="contactoTercero" id="contactoTercero" class="form-control">
                            <option value="">Seleccione</option>

                        </select>
                        <div id="divContactoTercero">
                            <a href="" id="wp_contacto" target="_blank"><i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="maquina">
                <div class="form-group">
                    <label for="maquina_id">Máquina:</label>
                    <select name="maquina_id[]" id="maquina_id" class="form-select" multiple="multiple">
                        @foreach ($maquinas as $id => $maquina)
                            <option value="{{ $id }}">{{ $maquina->tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row" id="div-detalle">
                <div class="form-group mt-3">
                    <button class="btn btn-outline-primary mb-5" id="boton-agregar-articulo" type="button">
                        <i class="fas fa-plus"></i>
                        Agregar artículo
                    </button>
                </div>
            </div>
            <div id="articulos">
                <input type="hidden" name="articulos-temporales" id="articulos-temporales">

            </div>


            <div id="comentariosPedido">
                {{-- comentarios del pedido --}}
                <label for="comentario">Comentarios del pedido</label>
                <textarea name="comentario" id="comentario" cols="20" rows="5" class="form-control"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Crear pedido</button>
            </div>
        </form>
    </div>






    {{-- Modal de clientes --}}
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="modalClientesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalClientesLabel">Buscar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" data-dismiss="modal" aria-label="Close">
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

@endsection
@section('js')
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
                $('#tercero_id').val($(this).data('id'));
                $('#cliente_nombre').val($(this).data('nombre'));
                $('#numero_documento').val($(this).data('identificacion'));
                $('#direccion').val($(this).data('direccion'));
                $('#telefono').val($(this).data('telefono'));
                $('#wp_cliente').attr('href', 'https://wa.me/+57' + $(this).data('telefono'));
                $('#wp_contacto').attr('href', 'https://wa.me/+57' + $(this).data('telefono'));

                $('#email').val($(this).data('email'));
                cargarMaquinas();
                cargarContactos();
            });

            //cargar maquinas
            function cargarMaquinas() {
                // Obtener el valor del ID del tercero seleccionado
                var tercero_id = $('#tercero_id').val();

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


            //cargar contactos de tercero
            function cargarContactos() {
                // Obtener el valor del ID del tercero seleccionado
                var tercero_id = $('#tercero_id').val();

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


            let contadorArticulos = 1;

            $('#boton-agregar-articulo').on('click', function() {

                $('#articulos').append(`

                <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="referencia">Referencia</label>
                                <select name="referencia${contadorArticulos}" id="referencia${contadorArticulos}" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($articulos as $id => $articulo)
                                    <option value="{{ $articulo->referencia }}">{{ $articulo->referencia }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sistema">Sistema</label>
                                <select name="sistema${contadorArticulos}" class="form-control" id="sistema${contadorArticulos}">
                                    <option value="">Seleccione</option>
                                    @foreach ($sistemas as $id => $nombre)
                                    <option value="{{ $nombre }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="definicion">Definición</label>
                                <input type="text" name="definicion${contadorArticulos}" id="definicion${contadorArticulos}" class="form-control"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" name="cantidad${contadorArticulos}" class="form-control" id="cantidad${contadorArticulos}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comentarios">Comentarios</label>
                                <textarea name="comentarios${contadorArticulos}" id="comentarios${contadorArticulos}" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="foto">Fotos (puede agregar varias)</label>
                                <input type="file" name="fotos${contadorArticulos}[]" multiple class="form-control" id="fotos${contadorArticulos}">
                            </div>
                        </div>
                    </div>
                </hr>


            `);

                $('#articulos-temporales').val(contadorArticulos++);

                // Almacenar los datos de $articulos en una variable JavaScript
                var articulos = {!! json_encode($articulos) !!};
                console.log(articulos);

                // Llenar campos de acuerdo a la referencia seleccionada
                $(`#referencia${contadorArticulos-1}`).change(function() {
                    var referencia = $(this).val();
                    console.log(referencia);

                    // Buscar el artículo en la lista de artículos
                    var articuloEncontrado = articulos.find(function(articulo) {
                        return articulo.referencia === referencia;
                    });

                    console.log(articuloEncontrado);

                    if (articuloEncontrado) {
                        $(`#sistema${contadorArticulos-1}`).val(articuloEncontrado.sistema);
                        $(`#definicion${contadorArticulos-1}`).val(articuloEncontrado.definicion);
                    } else {
                        console.log('No se encontró el artículo');
                    }
                });

            });
            //select2
            $('.form-select').select2({
                placeholder: "Seleccione una opción",
                allowClear: true
            });

        });
        if ($('#cantidad').val() == '') {
            $('#cantidad').val(1);

        }
    </script>
@endsection
