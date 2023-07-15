@extends('adminlte::page')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Pedidos</h1>
        <table id="pedidos" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Código de Pedido</th>
                    <th>Cliente</th>
                    <th>Máquina</th>
                    <th>Comenatarios</th>
                    <th>Contacto Cliente</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Modificación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    @if ($pedido->estado == 'Costeo')
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
                            <td>{{ $pedido->updated_at }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                                <a href="{{ route('costeos.costear', $pedido->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //filtrar listas por tipo
        $(document).ready(function() {

            $(function() {
                $('#pedidos').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                    },
                });
            });
        });
    </script>
@endsection
