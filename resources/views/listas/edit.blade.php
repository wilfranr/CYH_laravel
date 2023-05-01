@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Editar Lista</h1>

        <form action="{{ route('listas.update', ['id' => $lista->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select class="form-control" id="tipo" name="tipo">
                    @foreach ($listasPadre as $listaPadre)
                        @if ($listaPadre->nombre == $lista->tipo)
                            <option value="{{ $listaPadre->nombre }}" selected>{{ $listaPadre->nombre }}</option>
                        @else
                            <option value="{{ $listaPadre->nombre }}">{{ $listaPadre->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $lista->nombre }}"
                    required>
            </div>
            <div class="form-group">
                <label for="definicion">Definición:</label>
                <textarea name="definicion">{{ $lista->definicion }}</textarea>

            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control-file" name="fotoLista" id="fotoLista">
            </div>
            <a href="{{ route('listas.index')}}" class="btn btn-secondary">Volver</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
