@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Crear Nueva Lista</h1>
        <form action="{{ route('listas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" name="tipo" id="tipo" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="definicion">Definición:</label>
                <textarea class="form-control" name="definicion" id="definicion" required></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control-file" name="foto" id="foto">
            </div>
            <button type="submit" class="btn btn-primary">Crear Lista</button>
        </form>
    </div>
@endsection
