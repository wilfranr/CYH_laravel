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
                    <th>Código de Usuario</th>
                    <th>Código de Cliente</th>
                    <th>Código de Máquina</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Modificación</th>
                    <th>Descripción</th>
                    <th>Contacto</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->codPedido }}</td>
                        <td>{{ $pedido->codUsuario }}</td>
                        <td>{{ $pedido->codCliente }}</td>
                        <td>{{ $pedido->codMaquina }}</td>
                        <td>{{ $pedido->fecha_creacion }}</td>
                        <td>{{ $pedido->fecha_modificacion }}</td>
                        <td>{{ $pedido->descripcion }}</td>
                        <td>{{ $pedido->contacto }}</td>
                        <td>{{ $pedido->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
