@extends('adminlte::page')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pedidos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="pedidos" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código de Pedido</th>
                                    <th>Cliente</th>
                                    <th>Máquina</th>
                                    <th>Comentarios</th>
                                    <th>Contacto Cliente</th>
                                    <th>Fecha de Creación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    @if ($pedido->estado == 'Nuevo')
                                        <tr>
                                            <td>{{ $pedido->id }}</td>
                                            <td>{{ $pedido->tercero->nombre }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($pedido->maquinas as $maquina)
                                                        <li>{{ $maquina->tipo }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $pedido->comentario }}</td>
                                            <td>
                                                @if ($pedido->contacto && $pedido->contacto->nombre)
                                                    {{ $pedido->contacto->nombre }}
                                                @endif
                                            </td>
                                            <td>{{ $pedido->created_at }}</td>
                                            <td>{{ $pedido->estado }}</td>
                                            <td>
                                                <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-primary"
                                                    title="Ver">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning"
                                                    title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger delete" title="Eliminar">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('pedidos.create') }}" class="btn btn-primary mt-3">Crear Pedido</a>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
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

            $('.delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, bórralo'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                        //tiempo de espera para que se ejecute el submit
                        setTimeout(function() {
                            Swal.fire(
                                '¡Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            )
                        }, 500);
                    }
                })
            });
        });
    </script>
@endsection
