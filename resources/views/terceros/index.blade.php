@extends('adminlte::page')
@section('title', 'Terceros')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
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
                    <th>Razón Social</th>
                    <th>Tipo</th>
                    <th>Identificacion</th>
                    <th>Teléfono</th>
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
                            {{ $tercero->telefono }}
                            <a href="https://wa.me/{{ $tercero->telefono }}" target="_blank"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg></a>
                        </td>

                        <td>
                            <a href="{{ route('terceros.show', $tercero->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('terceros.edit', $tercero->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
