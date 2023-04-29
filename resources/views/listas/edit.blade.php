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
                    @foreach($listasPadre as $listaPadre)
                        <option value="{{ $listaPadre->nombre }}">{{ $listaPadre->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $lista->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="definicion">Definición:</label>
                <textarea name="definicion">{{ $lista->definicion }}</textarea>

            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control-file" name="foto" id="foto">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
