@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Listas</h1>
        <a href="{{ route('listas.create') }}" class="btn btn-primary mb-2">Crear Lista</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Definicion</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listas as $lista)
                    <tr>
                        <td>{{ $lista->tipo }}</td>
                        <td>{{ $lista->nombre }}</td>
                        <td>{{ $lista->definicion }}</td>
                        <td><img src="{{ asset('storage/fotos/'.$lista->foto) }}" alt="Foto de la lista" width="100px"></td>
                        <td>
                            <a href="{{ route('listas.show', $lista->id) }}" class="btn btn-sm btn-success">Ver</a>
                            <a href="{{ route('listas.edit', $lista->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('listas.destroy', $lista->id) }}" method="POST" style="display: inline">
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
@endsection

