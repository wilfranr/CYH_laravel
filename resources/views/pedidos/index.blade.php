@extends('layouts.app-master')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Pedidos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Código de Pedido</th>
                    <th>Cliente</th>
                    <th>Máquina</th>
                    <th>Comenatarios</th>
                    <th>Contacto Cliente</th>
                    <th>Fecha de Creación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->tercero->nombre }}</td>
                        <td>
                            <ul>
                                @foreach ($pedido->maquinas as $maquina)
                                    {{ $maquina->tipo }}
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $pedido->comentario }}</td>
                        {{-- Aca se muestra el nombre del contacto de este teercero --}}
                        <td>
                            @if ($pedido->contacto && $pedido->contacto->nombre)
                                {{ $pedido->contacto->nombre }}
                            @endif
                        </td>
                        <td>{{ $pedido->created_at }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-primary">Ver</a>
                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Está seguro de eliminar este pedido?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
