@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{ $user->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Rol:</strong> {{ $user->role }}</p>
                        <p><strong>Teléfono:</strong> {{ $user->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Creado en:</strong> {{ $user->created_at }}</p>
                        <p><strong>Actualizado en:</strong> {{ $user->updated_at }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
