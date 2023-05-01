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
                                        <th>Fabricante</th>
                                        {{-- <th>Sistema</th> --}}
                                        <th>Definición</th>
                                        <th>Referencia</th>
                                        <th>Comentarios</th>
                                        <th>Foto</th>
                                        <th>Foto medida</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articulos as $articulo)
                                        <tr>
                                            <td>{{ $articulo->marca }}</td>
                                            {{-- <td>{{ $articulo->sistema }}</td> --}}
                                            <td>{{ $articulo->definicion }}</td>
                                            <td>{{ $articulo->referencia }}</td>
                                            <td>{{ $articulo->comentarios }}</td>
                                            <td>
                                                <img src="{{ asset('storage/articulos/'. $articulo->fotoDescriptiva) }}" alt="Foto de la lista" width="100px"></td>
                                            <td>
                                                <img src="{{ asset('storage/' . $articulo->foto_medida) }}" alt=""
                                                    width="200"></td>
                                            <td>
                                                <a href="{{ route('articulos.show', $articulo->id) }}"
                                                    class="btn btn-sm btn-primary">Ver</a>
                                                <a href="{{ route('articulos.edit', $articulo->id) }}"
                                                    class="btn btn-sm btn-warning">Editar</a>
                                                <form action="{{ route('articulos.destroy', $articulo->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este artículo?')">Eliminar</button>
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
