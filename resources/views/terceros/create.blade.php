@extends('layouts.app-master')

@section('title', 'Crear tercero')

@section('content')

    <div class="container">
        <h1 class="mb-5">Crear tercero</h1>
        <form method="POST" action="{{ route('terceros.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group">
                    <label for="tipo">Tipo Tercero</label>
                    <select name="tipo" id="tipo" class="form-select">
                        <option value="">-- Seleccione un tipo --</option>
                        <option value="cliente" {{ old('tipo') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                        <option value="proveedor" {{ old('tipo') == 'proveedor' ? 'selected' : '' }}>Proveedor</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_documento">No. Documento</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control"
                            value="{{ old('numero_documento') }}">
                        <input type="hidden" name="puntos" value="{{ old('puntos') }}">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Razon social</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            value="{{ old('nombre') }}">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control"
                            value="{{ old('direccion') }}">
                    </div>
                    <div class="form-group">
                        <label for="pais_id">País</label>
                        <select name="pais_id" id="pais_id" class="form-control" required>
                            <option value="">Seleccione un país</option>
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->PaisCodigo }}">{{ $pais->PaisNombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email-facturacion">Email de Facturación</label>
                        <input type="email" name="email_facturacion" id="email-facturacion" class="form-control"
                            value="{{ old('email_facturacion') }}">
                    </div>
                    <div class="form-group">
                        <label for="rut">Rut</label>
                        <input type="file" name="rut" id="rut" class="form-control"
                            value="{{ old('rut') }}">

                    </div>
                    <div class="form-group border border-warning mt-4 p-3 maquina" id="maquina">

                        <label for="maquina">Máquina</label>
                        <select class="form-select2" name="maquinas[]" multiple="multiple">
                            @foreach ($maquinas as $maquina)
                                <option value="{{ $maquina['id'] }}">{{ $maquina['text'] }}</option>
                            @endforeach
                        </select>

                        <a href="{{ route('maquinas.create') }}" class="btn btn-primary mt-2">Agregar nueva máquina</a>
                    </div>
                    <div class="form-group border border-warning mt-4 p-3" id="rango">
                        <label for="rango">Rango de productos</label>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Marca</h4>
                                <ul>
                                    @foreach ($marcas as $marca)
                                    <li>
                                        <input type="checkbox" name="marca[]" value="{{ $marca->id }}" id="marca{{ $marca->id }}">
                                        <label for="marca{{ $marca->id }}">{{ $marca->nombre }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h4>Sistemas</h4>
                                <ul>
                                    @foreach ($sistemas as $sistema)
                                    <li>
                                        <input type="checkbox" name="sistema[]" value="{{ $sistema->id }}" id="sistema{{ $sistema->id }}">
                                        <label for="sistema{{ $sistema->id }}">{{ $sistema->nombre }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_documento">Tipo</label>
                        <select name="tipo_documento" id="tipo_documento" class="form-select" required>
                            <option value="">-- Seleccione un tipo de documento --</option>
                            <option value="cedula" {{ old('tipo_documento') == 'cedula' ? 'selected' : '' }}>Cédula de
                                ciudadanía</option>
                            <option value="nit" {{ old('tipo_documento') == 'nit' ? 'selected' : '' }}>Nit</option>
                            <option value="ce" {{ old('tipo_documento') == 'ce' ? 'selected' : '' }}>Cédula de
                                extranjería</option>
                        </select>
                        <div class="form-group" id="dv-field" style="display:none">
                            <label for="dv">DV</label>
                            <input type="text" class="form-control" id="dv" name="dv"
                                placeholder="Ingrese el digito de verificación del Nit" value="{{ old('dv') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control"
                            value="{{ old('telefono') }}">
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>

                        <select name="ciudad" id="ciudad" class="form-select" required>
                            <option value="">Seleccione una ciudad</option>



                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sitioWeb">Sitio Web</label>
                        <input type="text" name="sitioWeb" id="sitioWeb" class="form-control"
                            value="{{ old('sitioWeb') }}">
                    </div>
                    <div class="form-group">
                        <label for="certificacion_bancaria">Certificación bancaria</label>
                        <input type="file" name="certificacion_bancaria" id="certificacion_bancaria"
                            class="form-control" value="{{ old('certificacion_bancaria') }}">
                    </div>
                    <div class="border border-warning mt-4 p-3">
                        <hr>
                        <h2>Contactos de tercero</h2>
                        <div id="contactos">
                            <input type="hidden" name="contadorContactos" value="3">

                        </div>

                        <button type="button" class="btn btn-success" id="agregar-contacto">Agregar contacto</button>
                        <hr>
                    </div>

                </div>




        </form>
        <button type="submit" class="btn btn-primary mt-3">Crear tercero</button>
    </div>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">


    <!-- Incluye la librería de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        $(document).ready(function() {
            $('.form-select2').select2();
        });
    </script>
    <script>
        const paisSelect = document.getElementById('pais_id');
        paisSelect.addEventListener('change', function() {
            const paisCodigo = this.value;
            fetch('/ciudades/' + paisCodigo)
                .then(response => response.json())
                .then(data => {
                    const ciudadSelect = document.getElementById('ciudad');

                    ciudadSelect.innerHTML = '';
                    data.ciudades.forEach(ciudad => {
                        const option = document.createElement('option');
                        option.value = ciudad.CiudadID;
                        option.text = ciudad.CiudadNombre;
                        ciudadSelect.appendChild(option);

                    });
                });
        });
        $(document).ready(function() {
            // Obtener el elemento select
            const tipoDocumentoSelect = document.getElementById('tipo_documento');
            // Obtener el campo dv
            const dvField = document.getElementById('dv-field');
            //Agregar evento onchange al select
            tipoDocumentoSelect.addEventListener('change', function() {
                // Si la opción seleccionada es NIT, mostrar el campo dv
                dvField.style.display = tipoDocumentoSelect.value === 'nit' ? 'block' : 'none';
            });


            let contadorContactos = 1;

            $('#agregar-contacto').on('click', function() {
                $('#contactos').append(`
                <hr>
                <div class="form-group">
                    <label for="nombre_contacto_${contadorContactos}">Nombre:</label>
                    <input type="text" name="nombre_contacto_${contadorContactos}" id="nombre_contacto_${contadorContactos}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telefono_contacto_${contadorContactos}">Teléfono:</label>
                    <input type="text" name="telefono_contacto_${contadorContactos}" id="telefono_contacto_${contadorContactos}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email_contacto_${contadorContactos}">Correo electrónico:</label>
                    <input type="email" name="email_contacto_${contadorContactos}" id="email_contacto_${contadorContactos}" class="form-control">
                </div>
                </hr>

            `);

                contadorContactos++;
            });
        });
        //si seleccione tipo tercero cliente, mostrar div #maquina
        $('.maquina').hide();
        $('#rango').hide();
        const tipoTerceroSelect = document.getElementById('tipo');
        const maquinaDiv = document.getElementById('maquina');
        tipoTerceroSelect.addEventListener('change', function() {
            if (tipoTerceroSelect.value === 'cliente') {
                $('.maquina').show();
                $('#rango').hide();
            } else {
                $('.maquina').hide();
                $('#rango').show();
            }
        });
    </script>

@endsection
