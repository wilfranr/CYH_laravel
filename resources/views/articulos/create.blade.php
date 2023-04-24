@extends('layouts.app-master')

@section('content')
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear Artículo') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('articulos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="sistema"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Sistema') }}</label>

                                <div class="col-md-6">
                                    <input id="sistema" type="text"
                                        class="form-control @error('sistema') is-invalid @enderror" name="sistema"
                                        value="{{ old('sistema') }}" required autofocus>

                                    @error('sistema')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="definicion"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Definición') }}</label>

                                <div class="col-md-6">
                                    <input id="definicion" type="text"
                                        class="form-control @error('definicion') is-invalid @enderror" name="definicion"
                                        value="{{ old('definicion') }}" required>

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
                                        value="{{ old('referencia') }}" required>

                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cantidad"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cantidad') }}</label>

                                <div class="col-md-6">
                                    <input id="cantidad" type="number"
                                        class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                        value="{{ old('cantidad') }}" required>

                                    @error('cantidad')
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
                                    <textarea id="comentarios" class="form-control @error('comentarios') is-invalid @enderror" name="comentarios" required>{{ old('comentarios') }}</textarea>

                                    @error('comentarios')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
