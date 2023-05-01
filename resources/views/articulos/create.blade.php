@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear artículo') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('articulos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="marca"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Marca fabricante') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="marca" name="marca">
                                        <option value="">Seleccione una marca fabricante</option>
                                        @foreach ($maquinas as $id => $nombre)
                                            <option value="{{ $nombre }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="tipo_maquina"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tipo de maquina') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="tipo_maquina" name="tipo_maquina">
                                        <option value="">Seleecione una máquina</option>
                                        @foreach ($maquinas as $maquina)
                                        <option value="{{ $maquina->id }}">{{ $maquina->tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row">
                                <label for="sistema"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Sistema') }}</label>

                                <div class="col-md-6">
                                    <select name="sistema" id="sistema" class="form-control">
                                        <option value="">Seleccione un sistema</option>
                                        @foreach ($sistemas as $id => $nombre)
                                            <option value="{{ $nombre }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="definicion"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Definición') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="definicion" name="definicion">
                                        <option value="">Seleccione una descripción común</option>
                                        @foreach ($definiciones as $id => $nombre)
                                            <option value="{{ $nombre }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referencia"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Referencia') }}</label>

                                <div class="col-md-6">
                                    <input id="referencia" type="text"
                                        class="form-control @error('referencia') is-invalid @enderror" name="referencia"
                                        value="{{ old('referencia') }}" required>

                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descripcion_especifica"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Descripción específica') }}</label>

                                <div class="col-md-6">
                                    <input id="descripcion_especifica" type="text"
                                        class="form-control @error('descripcion_especifica') is-invalid @enderror"
                                        name="descripcion_especifica" value="{{ old('descripcion_especifica') }}" required>

                                    @error('descripcion_especifica')
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
                                    <textarea id="comentarios" class="form-control @error('comentarios') is-invalid @enderror" name="comentarios">{{ old('comentarios') }}</textarea>

                                    @error('comentarios')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="peso"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Peso (lbs)') }}</label>

                                <div class="col-md-6">
                                    <input id="peso" type="text"
                                        class="form-control @error('peso') is-invalid @enderror" name="peso"
                                        value="{{ old('peso') }}" required>

                                    @error('peso')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Foto descriptiva --}}
                            <div class="form-group row">
                                <label for="foto-descriptiva"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Foto descriptiva') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="foto" id="foto" class="form-control-file">

                                </div>
                            </div>
                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary mt-3">Crear</button>
                                <a href="{{ route('articulos.index') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
