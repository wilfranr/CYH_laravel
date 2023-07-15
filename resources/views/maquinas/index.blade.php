@extends('adminlte::page')

@section('content')
    <style>
        #chat-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        #chat-box {
            display: none;
        }
    </style>
    <div id="chat-container">
        <button id="chat-toggle" class="btn btn-info"><i class=" fa fa-comments"></i> </button>
        <div id="chat-box" class="card">
            <div class="card-header">
                Chat
            </div>
            <div class="card-body">
                <!-- Aquí puedes agregar el contenido del chat -->
                <p>Bienvenido al chat. ¡Hazme una pregunta!</p>
            </div>
        </div>
    </div>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
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
                            @foreach ($maquinas as $maquina)
                                <tr>
                                    <td>{{ $maquina->id }}</td>
                                    <td>{{ $maquina->tipo }}</td>
                                    <td>{{ $maquina->marca }}</td>
                                    <td>{{ $maquina->modelo }}</td>
                                    <td>{{ $maquina->serie }}</td>
                                    <td>{{ $maquina->arreglo }}</td>
                                    <td>
                                        <a href="{{ asset('storage/maquinas/' . $maquina->foto) }}" target="_blank">
                                            <img src="{{ asset('storage/maquinas/' . $maquina->foto) }}"
                                                alt="Foto de la máquina" width="100px">
                                        </a>
                                    </td>
                                    <td>{{ $maquina->foto_id }}</td>
                                    <td>{{ $maquina->created_at }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('maquinas.show', $maquina->id) }}"
                                                class="btn btn-primary mx-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('maquinas.edit', $maquina->id) }}"
                                                class="btn btn-warning mx-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('maquinas.destroy', $maquina->id) }}"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mx-1 delete">
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
@endsection
@section('js')
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
            $('#chat-toggle').click(function() {
                $('#chat-box').slideToggle();
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
