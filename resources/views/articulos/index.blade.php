@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('articulos.create') }}" class="btn btn-primary">Crear Artículo</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fabricante de máquina</th>
                                        <th>Tipo de máquina</th>
                                        <th>Sistema</th>
                                        <th>Definición</th>
                                        <th>Referencia</th>
                                        <th>Cantidad</th>
                                        <th>Comentarios</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articulos as $articulo)
                                        <tr>
                                            <td>@foreach ($articulo->maquinas as $maquina)
                                                {{ $maquina->pivot->marca }}
                                            @endforeach</td>
                                            <td>
                                                @foreach ($articulo->maquinas as $maquina)
                                                    {{ $maquina->pivot->fabricante }}
                                                @endforeach
                                            </td>
                                            <td>{{ $articulo->sistema }}</td>
                                            <td>{{ $articulo->definicion }}</td>
                                            <td>{{ $articulo->referencia }}</td>
                                            <td>{{ $articulo->cantidad }}</td>
                                            <td>{{ $articulo->comentarios }}</td>
                                            <td>
                                                <a href="{{ route('articulos.show', $articulo->id) }}"
                                                    class="btn btn-sm btn-primary">Ver</a>
                                                <a href="{{ route('articulos.edit', $articulo->id) }}"
                                                    class="btn btn-sm btn-warning">Editar</a>
                                                <form action="{{ route('articulos.destroy', $articulo->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
