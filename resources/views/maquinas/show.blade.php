@extends('adminlte::page')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h1 class="card-title">{{ $maquina->tipo }}</h1>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <p><strong>Marca:</strong> {{ $maquina->marca }}</p>
          <p><strong>Tipo de máquina:</strong> {{ $maquina->tipo }}</p>
          <p><strong>Modelo:</strong> {{ $maquina->modelo }}</p>
          <p><strong>Serie:</strong> {{ $maquina->serie }}</p>
          <p><strong>Arreglo:</strong> {{ $maquina->arreglo }}</p>
        </div>
        <div class="col-md-6">
          <p><strong>Foto:</strong></p>
          <img src="{{ asset('storage/maquinas/'.$maquina->foto) }}" alt="Foto de la máquina" class="img-fluid">
          <p><strong>Foto ID:</strong> {{ $maquina->foto_id }}</p>
          <p><strong>Fecha de creación:</strong> {{ $maquina->created_at }}</p>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <a href="{{ route('maquinas.index') }}" class="btn btn-secondary">Regresar</a>
      <a href="{{ route('maquinas.edit', $maquina->id) }}" class="btn btn-primary">Editar</a>
      <form method="POST" action="{{ route('maquinas.destroy', $maquina->id) }}" style="display: inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar esta máquina?')">Eliminar</button>
      </form>
    </div>
  </div>
</div>
@endsection
