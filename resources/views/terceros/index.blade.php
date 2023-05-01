@extends('layouts.app-master')
@section('title', 'Terceros')

@section('content')
<div class="container">
    <h1>Terceros</h1>
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('terceros.create') }}" class="btn btn-primary">Agregar tercero</a>
            <input type="text" name="search" id="search" class="form-control" placeholder="Buscar">
        </div>
        </div>

        <table class="table" id="terceros-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Identificacion</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($terceros as $tercero)
                    <tr>
                        <td>{{ $tercero->id }}</td>
                        <td>{{ $tercero->nombre }}</td>
                        <td>{{ $tercero->tipo }}</td>
                        <td>{{ $tercero->numero_documento }}</td>
                        <td>
                            <a href="{{ route('terceros.show', $tercero->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('terceros.edit', $tercero->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('terceros.destroy', $tercero->id) }}" method="POST" style="display: inline">
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
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        //busqueda dinámica en tabla terceros
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection

