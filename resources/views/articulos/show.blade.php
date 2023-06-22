@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $articulo->definicion }}</div>

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
                            <div class="col-md-3 font-weight-bold">Marca:</div>
                            <div class="col-md-9">{{ $articulo->marca }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 font-weight-bold">Comentarios:</div>
                            <div class="col-md-9">{{ $articulo->comentarios }}</div>
                        </div>


                        <div class="row">
                            <div class="col-md-3 font-weight-bold">Foto descriptiva:</div>
                            <div class="col-md-9"><a href="{{ asset('storage/articulos/' . $articulo->fotoDescriptiva) }}"
                                    target="_blank"><img
                                        src="{{ asset('storage/articulos/' . $articulo->fotoDescriptiva) }}"
                                        alt="Foto de articulo" width="200px"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 font-weight-bold">Foto medida:</div>
                            <div class="col-md-9">
                                <a href="{{ asset('storage/articulos/' . $articulo->fotoMedida) }}" target="_blank">
                                    <img src="{{ asset('storage/articulos/' . $articulo->fotoMedida) }}"
                                        alt="Foto de medida" width="200px">
                                </a>
                            </div>
                        </div>
                        @foreach ($articulo->medidas as $index => $medida)
                            <h3>Medida {{ $index + 1 }}</h3>
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">Tipo Medida:</div>
                                <p>{{ isset($medida->nombre) ? $medida->nombre : '' }} </p>
                            </div>
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">Valor:</div>
                                <p>{{ isset($medida->valor) ? $medida->valor : '' }}
                                    {{ isset($medida->unidad) ? $medida->unidad : '' }} </p>
                            </div>
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">Id:</div>
                                <p>{{ isset($medida->idMedida) ? $medida->idMedida : '' }} </p>
                            </div>
                        @endforeach



                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{ route('articulos.index') }}" class="btn btn-secondary">Volver</a>
                                <a href="{{ route('articulos.edit', $articulo->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('articulos.destroy', $articulo->id) }}" method="POST"
                                    class="d-inline-block">
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
