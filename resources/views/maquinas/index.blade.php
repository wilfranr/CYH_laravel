@extends('layouts.app-master')

@section('content')
<div class="container">
    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    <h1>Maquinas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Arreglo</th>
                <th>Foto</th>
                <th>Foto ID</th>
                <th>Fecha de creación</th>

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
                    <td>{{ $maquina->serie }}</td>
                    <td>{{ $maquina->arreglo }}</td>
                    <td>
                        <a href="{{ asset('storage/maquinas/'.$maquina->foto) }}" target="_blank">
                            <img src="{{ asset('storage/maquinas/'.$maquina->foto) }}" alt="Foto de la máquina" width="100px">
                        </a>
                        
                    </td>

                    <td>{{ $maquina->foto_id }}</td>
                    <td>{{ $maquina->created_at }}</td>
                    <td>
                        <a href="{{ route('maquinas.show', $maquina->id) }}" class="btn btn-primary">Ver</a>
                        <a href="{{ route('maquinas.edit', $maquina->id) }}" class="btn btn-warning">Editar</a>
                        <form method="POST" action="{{ route('maquinas.destroy', $maquina->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta maquina?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('maquinas.create') }}" class="btn btn-success">Agregar máquina</a>

</div>
@endsection
