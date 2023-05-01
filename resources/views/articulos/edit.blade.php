@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Artículo') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('articulos.update', $articulo->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="form-group row">
                                    <label for="marca"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Marca fabricante') }}</label>
    
                                    <div class="col-md-6">
                                        <select class="form-control" id="marca" name="marca" required>
                                            <option value="">Seleccione una marca fabricante</option>
                                            @foreach($marca as $m)
                                                <option value="{{ $m->nombre }}" {{ $m->nombre == $articulo->marca ? 'selected' : '' }}>{{ $m->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <label for="sistema"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Sistema') }}</label>

                                <div class="col-md-6">
                                    <input id="sistema" type="text"
                                        class="form-control @error('sistema') is-invalid @enderror" name="sistema"
                                        value="{{ $articulo->sistema }}" required autofocus>

                                    @error('sistema')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                            </div>

                            <div class="form-group row">
                                <label for="definicion"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Definición') }}</label>

                                <div class="col-md-6">
                                    <input id="definicion" type="text"
                                        class="form-control @error('definicion') is-invalid @enderror" name="definicion"
                                        value="{{ $articulo->definicion }}" required>

                                    @error('definicion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referencia"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Referencia') }}</label>

                                <div class="col-md-6">
                                    <input id="referencia" type="text"
                                        class="form-control @error('referencia') is-invalid @enderror" name="referencia"
                                        value="{{ $articulo->referencia }}" required>

                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            

                            <div class="form-group row">
                                <label for="comentarios"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Comentarios') }}</label>

                                <div class="col-md-6">
                                    <textarea id="comentarios" class="form-control  name="comentarios" >{{ $articulo->comentarios }}</textarea>

                            
                                </div>
                            </div>
                            {{-- Foto descriptiva --}}
                            <div class="form-group row">
                                <label for="foto-descriptiva"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Foto descriptiva') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="foto-descriptiva" id="foto-descriptiva" class="form-control-file">

                                </div>
                            </div>
                            <button class="btn btn-outline-primary" type="submit">Guardar</button>
                            <a href="{{ route('articulos.index') }}" class="btn btn-secondary">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
