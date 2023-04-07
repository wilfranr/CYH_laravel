@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Terceros</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" name="search" id="search" class="form-control" placeholder="Buscar">
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terceros as $tercero)
                    <tr>
                        <td>{{ $tercero->id }}</td>
                        <td>{{ $tercero->nombre }}</td>
                        <td>{{ $tercero->tipo }}</td>
                        <td>
                            <a href="{{ route('terceros.show', $tercero->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('terceros.edit', $tercero->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('terceros.destroy', $tercero->id) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Está seguro de que desea eliminar este tercero?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('terceros.create') }}" class="btn btn-primary">Agregar tercero</a>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('search') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
            })
        });
        success: function(data) {
            var tableBody = $('#table-body');
            tableBody.empty();

            $.each(data.data, function(index, tercero) {
                var row = '<tr>';
                row += '<td>' + tercero.nombre + '</td>';
                row += '<td>' + tercero.apellido + '</td>';
                row += '<td>' + tercero.cedula + '</td>';
                // Agregar más columnas según las necesidades
                row += '</tr>';
                tableBody.append(row);
            });

            // Agregar código para mostrar la paginación
        }
    </script>
@endpush
