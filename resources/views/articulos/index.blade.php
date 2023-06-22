@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Artículos</h1>
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
                                                    class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('articulos.edit', $articulo->id) }}"
                                                    class="btn btn-sm btn-warning">🖋</a>
                                                <form action="{{ route('articulos.destroy', $articulo->id) }}"
                                                    method="POST" style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Está seguro de que desea eliminar este artículo?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
