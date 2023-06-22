@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Tercero') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('terceros.update', $tercero->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group">
                                    <label for="tipo">Tipo Tercero</label>
                                    <select name="tipo" id="tipo" class="form-control select2">
                                        <option value="">Seleccione un tipo de tercero</option>
                                        <option value="cliente"
                                            {{ $tercero->tipo == 'cliente' ? 'selected' : 'proveedor' }}>
                                            Cliente</option>
                                        <option value="proveedor"
                                            {{ $tercero->tipo == 'proveedor' ? 'selected' : 'cliente' }}>Proveedor</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numero_documento">No. Documento</label>
                                        <input type="text" name="numero_documento" id="numero_documento"
                                            class="form-control" value="{{ $tercero->numero_documento }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Razon social</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control"
                                            value="{{ $tercero->nombre }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control"
                                            value="{{ $tercero->direccion }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="pais_id">País</label>
                                        <select name="pais_id" id="pais_id" class="form-select" required>
                                            <option value="">Seleccione un país</option>
                                            <option value="{{ $tercero->pais_id }}" selected>
                                                {{ $tercero->pais->PaisNombre }}</option>
                                            @foreach ($paises as $pais)
                                                @if ($pais->PaisCodigo != $tercero->pais_id)
                                                    <option value="{{ $pais->PaisCodigo }}">{{ $pais->PaisNombre }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="email-facturacion">Email de Facturación</label>
                                        <input type="email" name="email_facturacion" id="email-facturacion"
                                            class="form-control" value="{{ $tercero->email_factura_electronica }}">
                                    </div>

                                    <div>
                                        <h3>Rut</h3>
                                        @if ($tercero->rut)
                                            <embed src="{{ asset('storage/' . $tercero->rut) }}" width="100%"
                                                height="600">
                                            <a href="{{ asset('storage/' . $tercero->rut) }}" target="_blank"
                                                class="btn btn-outline-primary">Ver en una
                                                pestaña nueva</a>
                                        @endif
                                        @if (!$tercero->rut)
                                            <p>No hay archivo PDF</p>
                                        @endif

                                    </div>

                                    <form method="POST" action="{{ route('terceros.updateRut', $tercero->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            @if ($tercero->rut)
                                                <label for="rut">Cambiar archivo PDF</label>
                                            @endif
                                            <input type="file" class="form-control-file" id="rut" name="rut">
                                        </div>
                                    </form>
                                    
                                    <div class="form-group border border-warning mt-4 p-3">
                                        
                                        <label for="maquina">Máquinas</label>
                                        {{-- mostrar una lista de las maquinas que tiene el tercero --}}
                                        @if ($tercero->maquinas->isEmpty())
                                            <p>No hay máquinas registradas</p>
                                            @endif
                                            <ul>
                                                @foreach ($tercero->maquinas as $maquina)
                                                <li>{{ $maquina->tipo }} {{ $maquina->marca }} {{ $maquina->modelo }}
                                                    {{ $maquina->serie }}</li>
                                                    @endforeach
                                                </ul>
                                                
                                                <a href="{{ route('maquinas.create') }}" class="btn btn-primary mt-2">Agregar nueva
                                                    máquina</a>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tipo_documento">Tipo</label>
                                                    <input type="text" class="form-control" value="{{ $tercero->tipo_documento }}"
                                                    readonly>
                                        <div class="form-group" id="dv-field" style="display:none">
                                            <label for="dv">DV</label>
                                            <input type="text" class="form-control" id="dv" name="dv"
                                            placeholder="Ingrese el digito de verificación del Nit"
                                            value="{{ old('dv') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $tercero->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control"
                                        value="{{ $tercero->telefono }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        
                                        
                                        <select name="ciudad_id" id="ciudad_id" class="form-select">
                                            <option value="">Seleccione una ciudad</option>
                                            @if ($tercero->ciudad)
                                            <option value="{{ $tercero->ciudad->CiudadID }}" selected>
                                                {{ $tercero->ciudad->CiudadNombre }}</option>
                                            @endif
                                        </select>
                                        
                                        <script>
                                            const paisSelect = document.getElementById('pais_id');
                                            const ciudadSelect = document.getElementById('ciudad_id');
                                            paisSelect.addEventListener('change', function() {
                                                const paisCodigo = this.value;
                                                fetch('/ciudades/' + paisCodigo)
                                                .then(response => response.json())
                                                .then(data => {
                                                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                                                    data.ciudades.forEach(ciudad => {
                                                        const option = document.createElement('option');
                                                        option.value = ciudad.CiudadID;
                                                        option.text = ciudad.CiudadNombre;
                                                        ciudadSelect.appendChild(option);
                                                    });
                                                    @if ($tercero->ciudad)
                                                    ciudadSelect.value = '{{ $tercero->ciudad->CiudadID }}';
                                                    @endif
                                                });
                                            });
                                            
                                            // Trigger the change event on page load to load the cities for the selected country
                                            const event = new Event('change');
                                            paisSelect.dispatchEvent(event);
                                        </script>



</div>

<div class="form-group">
    <label for="sitioWeb">Sitio Web</label>
    <input type="text" name="sitioWeb" id="sitioWeb" class="form-control"
                                            value="{{ $tercero->sitio_web }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="certificacion_bancaria">Certificación bancaria</label>
                                            <ul>
                                                @if ($tercero->certificacion_bancaria)
                                                <li><a
                                                    href="{{ route('terceros.downloadCertificacion', ['id' => $tercero->id]) }}">Descargar</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="border border-warning mt-4 p-3">
                                            <hr>
                                            <h2>Contactos de tercero</h2>
                                            <div id="contactos">
                                                <input type="hidden" name="contadorContactos" value="2">
                                                
                                            </div>
                                            
                                            <button type="button" class="btn btn-success" id="agregar-contacto">Agregar
                                                contacto</button>
                                                <hr>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Incluye la librería de jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            // Obtener el elemento select
            const tipoDocumentoSelect = document.getElementById('tipo_documento');
            // Obtener el campo dv
            const dvField = document.getElementById('dv-field');
            //Agregar evento onchange al select
            // tipoDocumentoSelect.addEventListener('change', function() {
            //     // Si la opción seleccionada es NIT, mostrar el campo dv
            //     dvField.style.display = tipoDocumentoSelect.value === 'nit' ? 'block' : 'none';
            // });

            $(document).ready(function() {
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
                // select2
                $('.form-select').select2({
                    theme: 'bootstrap4'
                });
            });

        </script>
    </div>
@endsection
