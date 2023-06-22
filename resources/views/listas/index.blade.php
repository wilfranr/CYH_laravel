@extends('adminlte::page')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif


        <h1>Listas</h1>
        



        <a href="{{ route('listas.create') }}" class="btn btn-primary mb-2">Crear Lista</a>
        <table id="listas" class="table table-bordered table-striped">
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
                        <td>
                            <a href="{{ asset('storage/listas/' . $lista->foto) }}" target="_blank">
                                <img src="{{ asset('storage/listas/' . $lista->foto) }}" alt="Foto de la lista"
                                    width="100px">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('listas.show', $lista->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('listas.edit', $lista->id) }}" class="btn btn-sm btn-primary">🖋</a>
                            <form action="{{ route('listas.destroy', $lista->id) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Está seguro de que desea eliminar esta lista?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
            
            $(function() {
            $('#listas').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
        });
    </script>
@endsection
