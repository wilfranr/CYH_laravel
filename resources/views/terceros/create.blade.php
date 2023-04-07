@extends('layouts.app-master')

@section('title', 'Crear tercero')

@section('content')
    <div class="container">
        <h1 class="mb-5">Crear tercero</h1>
        <form method="POST" action="{{ route('terceros.store') }}">
            @csrf
            <div class="row">
                <div class="form-group">
                    <label for="rol">Tipo Tercero</label>
                    <select name="rol" id="rol" class="form-control">
                        <option value="">-- Seleccione un tipo --</option>
                        <option value="cliente" {{ old('rol') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                        <option value="proveedor" {{ old('rol') == 'proveedor' ? 'selected' : '' }}>Proveedor</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_documento">No. Documento</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control"
                            value="{{ old('numero_documento') }}">
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
                        <label for="pais">País</label>
                        <select class="form-control" name="pais_id">
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                            
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_documento">Tipo</label>
                        <select name="tipo_documento" id="tipo_documento" class="form-control">
                            <option value="">-- Seleccione un tipo de documento --</option>
                            <option value="cedula" {{ old('tipo_documento') == 'cedula' ? 'selected' : '' }}>Cédula de
                                ciudadanía</option>
                            <option value="nit" {{ old('tipo_documento') == 'nit' ? 'selected' : '' }}>Nit</option>
                            <option value="ce" {{ old('tipo_documento') == 'ce' ? 'selected' : '' }}>Cédula de
                                extranjería</option>
                        </select>
                    </div>
                    <div class="form-group" id="dv-field" style="display:none">
                        <label for="dv">DV</label>
                        <input type="text" class="form-control" id="dv" name="dv">
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
                </div>
                <div class="col-md-6">


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Crear tercero</button>
        </form>
    </div>
@endsection


