@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Artículos</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <i class="fas fa-check"></i>
                    <strong>¡Éxito!</strong>
                    {{ session('success') }}
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
                            <table id="articulos" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Fabricante</th>
                                        {{-- <th>Sistema</th> --}}
                                        <th>Definición</th>
                                        <th>Referencia</th>
                                        <th>Comentarios</th>
                                        <th>Foto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articulos as $articulo)
                                        <tr>
                                            <td>{{ $articulo->id }}</td>
                                            <td>{{ $articulo->marca }}</td>
                                            {{-- <td>{{ $articulo->sistema }}</td> --}}
                                            <td>{{ $articulo->definicion }}</td>
                                            <td>{{ $articulo->referencia }}</td>
                                            <td>{{ $articulo->comentarios }}</td>
                                            <td>
                                                <a href="{{ asset('storage/articulos/' . $articulo->fotoDescriptiva) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/articulos/' . $articulo->fotoDescriptiva) }}"
                                                        alt="Foto de la lista" width="100px">
                                                </a>
                                            </td>

                                            <td>
                                                <a href="{{ route('articulos.show', $articulo->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-eye"
                                                        aria-hidden="true"></i></a>
                                                <a href="{{ route('articulos.edit', $articulo->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('articulos.destroy', $articulo->id) }}"
                                                    method="POST" style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete"><i
                                                            class="fas fa-trash-alt"></i></button>
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
@section('js')
    <script>
        $(function() {
            $('#articulos').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                "scrollY": true,
                "scrollY": "550px",
                "scrollCollapse": true,                
            });
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
    </script>
@endsection
