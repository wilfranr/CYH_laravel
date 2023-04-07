@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Pedido # {{ $ultimoPedido }}</h1>
        <form action="" method="post">
            @csrf
            <div class="form-group">
                {{-- boton para buscar cliente --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buscarClienteModal" x-data="{ showModal: false }">
                    Buscar cliente
                </button>
                {{-- modal para buscar cliente --}}
                <buscar-cliente-modal />
                {{-- input para mostrar el nombre del cliente --}}
            </div>
        </form>
    </div>

@endsection
