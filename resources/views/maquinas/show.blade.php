@extends('layouts.app-master')

@section('content')
<div class="container">
  <h1>{{ $maquina->tipo }}</h1>
  <p><strong>Marca:</strong> {{ $maquina->marca }}</p>
  <p><strong>Modelo:</strong> {{ $maquina->modelo }}</p>
  <p><strong>Serie:</strong> {{ $maquina->serie }}</p>
  <p><strong>Arreglo:</strong> {{ $maquina->arreglo }}</p>
  <p><strong>Foto:</strong> {{ $maquina->foto }}</p>
  <p><strong>Foto ID:</strong> {{ $maquina->foto_id }}</p>
  <p><strong>Fecha de creación:</strong> {{ $maquina->created_at }}</p>
  <a href="{{ route('maquinas.index') }}" class="btn btn-secondary">Regresar</a>

  
  <a href="{{ route('maquinas.edit', $maquina->id) }}" class="btn btn-primary">Editar</a>
  
  <form method="POST" action="{{ route('maquinas.destroy', $maquina->id) }}" style="display: inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar esta máquina?')">Eliminar</button>
  </form>
</div>
@endsection
