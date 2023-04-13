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
                    <select name="tipo" id="tipo" class="form-control">
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

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_documento">Tipo</label>
                        <select name="tipo_documento" id="tipo_documento" class="form-control" required>
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
                    
                    <select name="ciudad" id="ciudad" class="form-control" required>
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
                        <input type="file" name="certificacion_bancaria" id="certificacion_bancaria" class="form-control"
                            value="{{ old('certificacion_bancaria') }}">
                    </div>
                </div>
                <div class="col-md-6 border border-warning mt-4">


                    <div class="form-group">
                        <h3>Contactos de tercero</h3>
                        <label for="contactos">Contacto 1:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="contactos" id="contactos" class="form-control"
                                    value="{{ old('contactos') }}" placeholder="Nombre">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="contactos" id="contactos" class="form-control"
                                    value="{{ old('contactos') }}" placeholder="Teléfono">
                            </div>
                        </div>
                        <label for="contactos">Contacto 2:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="contactos" id="contactos" class="form-control"
                                    value="{{ old('contactos') }}" placeholder="Nombre">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="contactos" id="contactos" class="form-control"
                                    value="{{ old('contactos') }}" placeholder="Teléfono">
                            </div>
                        </div>
                        <label for="contactos">Contacto 3:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="contactos" id="contactos" class="form-control"
                                    value="{{ old('contactos') }}" placeholder="Nombre">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="contactos" id="contactos" class="form-control"
                                    value="{{ old('contactos') }}" placeholder="Teléfono">
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <button type="submit" class="btn btn-primary mt-3">Crear tercero</button>
    </div>
@endsection
