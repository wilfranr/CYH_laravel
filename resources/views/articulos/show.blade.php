@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $articulo->sistema }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 font-weight-bold">Definición:</div>
                            <div class="col-md-9">{{ $articulo->definicion }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 font-weight-bold">Referencia:</div>
                            <div class="col-md-9">{{ $articulo->referencia }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 font-weight-bold">Cantidad:</div>
                            <div class="col-md-9">{{ $articulo->cantidad }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 font-weight-bold">Comentarios:</div>
                            <div class="col-md-9">{{ $articulo->comentarios }}</div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{ route('articulos.index') }}" class="btn btn-secondary">Volver</a>
                                <a href="{{ route('articulos.edit', $articulo->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('articulos.destroy', $articulo->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
