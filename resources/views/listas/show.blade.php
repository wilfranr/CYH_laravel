@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $lista->tipo }} - {{ $lista->nombre }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="definicion" class="col-md-4 col-form-label text-md-right">{{ __('Definición') }}</label>

                            <div class="col-md-6">
                                <textarea id="definicion" class="form-control" readonly>{{ $lista->definicion }}</textarea>
                            </div>
                        </div>

                        @if($lista->foto)
                            <div class="form-group row">
                                <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                                <div class="col-md-6">
                                    <img src="{{ asset($lista->foto) }}" alt="{{ $lista->nombre }}" class="img-fluid">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
