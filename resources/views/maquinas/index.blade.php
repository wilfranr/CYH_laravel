@extends('layouts.app-master')

@section('content')
<div class="container">
    <h1>Maquinas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maquinas as $maquina)
                <tr>
                    <td>{{ $maquina->id }}</td>
                    <td>{{ $maquina->tipo }}</td>
                    <td>{{ $maquina->marca }}</td>
                    <td>{{ $maquina->modelo }}</td>
                    <td>
                        <a href="{{ route('maquinas.show', $maquina->id) }}" class="btn btn-primary">Ver</a>
                        <a href="{{ route('maquinas.edit', $maquina->id) }}" class="btn btn-warning">Editar</a>
                        <form method="POST" action="{{ route('maquinas.destroy', $maquina->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('maquinas.create') }}" class="btn btn-success">Agregar máquina</a>

</div>
@endsection