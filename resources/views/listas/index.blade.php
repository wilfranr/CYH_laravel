@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Listas</h1>
        <label  for="tipo">Filtrar</label>
        <select class="form-control" id="tipo" name="tipo" required>
            <option value="">Todos</option>
            @php
                $tipos = [];
            @endphp
            @foreach ($listas as $l)
                @php
                    $tipos[] = $l->tipo;
                @endphp
            @endforeach
            @foreach (array_unique($tipos) as $tipo)
                <option value="{{ $tipo }}" {{ $tipo == $l->tipo ? 'selected' : '' }}>{{ $tipo }}
                </option>
            @endforeach
        </select>



        <a href="{{ route('listas.create') }}" class="btn btn-primary mb-2">Crear Lista</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Definicion</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- ordenar en orden alfabetico --}}
                @php
                    $listas = $listas->sortBy('tipo');
                @endphp
                @foreach ($listas as $lista)
                    <tr>
                        <td>{{ $lista->tipo }}</td>
                        <td>{{ $lista->nombre }}</td>
                        <td>{{ $lista->definicion }}</td>
                        <td><img src="{{ asset('storage/listas/'. $lista->foto) }}" alt="Foto de la lista" width="100px"></td>
                        <td>
                            <a href="{{ route('listas.show', $lista->id) }}" class="btn btn-sm btn-success">Ver</a>
                            <a href="{{ route('listas.edit', $lista->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('listas.destroy', $lista->id) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta lista?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //filtrar listas por tipo
        $(document).ready(function() {
            $('#tipo').on('change', function() {
                var value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
