@extends('adminlte::page')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger delete">{{ __('Delete') }}</button>
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
        {{-- Boton para crear usuarios --}}
        <a href="{{ route('register') }}" class="btn btn-outline-primary">Crear usuario</a>
    </div>
@endsection
@section('js')
    <script>
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
