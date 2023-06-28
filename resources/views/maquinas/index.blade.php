@extends('adminlte::page')

@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>Maquinas</h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="maquinas" class="table table-bordered table-striped">
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
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('maquinas.show', $maquina->id) }}" class="btn btn-primary mx-1">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('maquinas.edit', $maquina->id) }}" class="btn btn-warning mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('maquinas.destroy', $maquina->id) }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-1" onclick="return confirm('¿Está seguro de que desea eliminar esta maquina?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <a href="{{ route('maquinas.create') }}" class="btn btn-success">Agregar máquina</a>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#maquinas').DataTable({
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
</script>
@endsection