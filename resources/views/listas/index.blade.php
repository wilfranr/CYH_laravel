@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Listas</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif


        <a href="{{ route('listas.create') }}" class="btn btn-primary mb-2">Crear Lista</a>

        <table id="listas" class="table table-bordered table-striped">
            <thead>
                <select class="form-control" id="filtro-tipo">
                    <option value="">Filtrar Todos</option>
                    <option value="Marca">Marca</option>
                    <option value="Definición">Definición</option>
                    <option value="Sistema">Sistema</option>
                    <option value="Medida">Medida</option>
                    <option value="TipoMedida">Tipo de Medida</option>
                    <option value="Definición">Definición</option>

                </select>
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
                            <a href="{{ route('listas.show', $lista->id) }}" class="btn btn-sm btn-success"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('listas.edit', $lista->id) }}" class="btn btn-sm btn-primary">🖋</a>
                            <form id="deleteForm" action="{{ route('listas.destroy', $lista->id) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger delete" id="delete-lista">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#listas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                "scrollY": "550px", 
                "scrollCollapse": true, 
                "paging": false, 
            });
            // Agregar filtro por tipo
            $('#filtro-tipo').on('change', function() {
                var table = $('#listas').DataTable();
                var tipo = $(this).val();
                table.column(0).search(tipo).draw();
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
