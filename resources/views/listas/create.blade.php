@extends('layouts.app-master')

@section('content')
    <div class="container">
        <h1>Crear Nueva Lista</h1>
        <form action="{{ route('listas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="0">Seleccione un tipo</option>
                    @foreach ($listasPadre as $listaPadre)
                        <option value="{{ $listaPadre->nombre }}">{{ $listaPadre->nombre }}</option>
                    @endforeach
                </select>
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
                <label for="fotoLista">Foto:</label>
                <input type="file" class="form-control" name="fotoLista" id="fotoLista">
                <img id="preview" src="#" alt="Vista previa de la imagen"
                    style="max-width: 200px; max-height: 200px;">
            </div>
            <button type="submit" class="btn btn-primary">Crear Lista</button>
        </form>
    </div>
    <script>
        // Obtener el elemento del input de carga de archivo y el elemento de la vista previa
        var inputImagen = document.getElementById('fotoLista');
        var imagenPreview = document.getElementById('preview');

        // Agregar un evento de cambio al input de carga de archivo
        inputImagen.addEventListener('change', function() {
            // Verificar si se seleccionó un archivo
            if (inputImagen.files && inputImagen.files[0]) {
                // Crear un objeto FileReader para leer el archivo
                var reader = new FileReader();

                // Configurar la función de carga del FileReader
                reader.onload = function(e) {
                    // Asignar la imagen cargada a la vista previa
                    imagenPreview.src = e.target.result;
                }

                // Leer el archivo seleccionado como una URL de datos
                reader.readAsDataURL(inputImagen.files[0]);
            }
        });
    </script>
@endsection
