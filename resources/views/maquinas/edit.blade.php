@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Editar Máquina</h1>

        <form method="POST" action="{{ route('maquinas.update', $maquina->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" value="{{ $maquina->nombre }}" required>
                @error('tipo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="marca">Marca</label>
                <textarea class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca" required>{{ $maquina->marca }}</textarea>
                @error('marca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <textarea class="form-control @error('modelo') is-invalid @enderror" id="modelo" name="modelo" required>{{ $maquina->modelo }}</textarea>
                @error('modelo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('maquinas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
