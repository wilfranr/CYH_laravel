@extends('layouts.app-master')

@section('content')
<div class="container">
    <h1>Listas padres</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listasPadre as $listaPadre)
                <tr>
                    <td>{{ $listaPadre->nombre }}</td>
                    <td>
                        <a href="{{ route('listasPadre.edit', $listaPadre) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('listasPadre.destroy', $listaPadre) }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('listasPadre.create') }}" class="btn btn-primary">Crear Lista</a>
</div>
@endsection