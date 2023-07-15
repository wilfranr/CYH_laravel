@extends('adminlte::page')

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
                <div class="input-group">
                    <input type="file" class="custom-file-input" name="fotoLista" id="fotoLista">
                    <label class="custom-file-label" for="fotoLista">Seleccionar imágen</label>
                </div>

                <img id="preview" src="#" alt="Vista previa de la imagen"
                    style="max-width: 200px; max-height: 200px;">
            </div>
            <div class="form-group fotoMedida">
                <label for="fotoMedida">Foto Medida:</label>
                <div class="input-group">
                    <input type="file" class="custom-file-input" name="fotoMedida" id="fotoMedida">
                    <label class="custom-file-label" for="fotoMedida">Seleccionar imágen</label>
                </div>
                <img id="preview2" src="#" alt="Vista previa de la imágen"
                    style="max-width: 200px; max-height: 200px;">

            </div>

            <button type="submit" class="btn btn-primary">Crear Lista</button>
            <a href="{{ route('listas.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
    <!-- Incluye la librería de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.fotoMedida').hide();
        });

        // Obtener los elementos del input de carga de archivo y los elementos de la vista previa
        var inputImagen = document.getElementById('fotoLista');
        var imagenPreview = document.getElementById('preview');
        var inputImagen2 = document.getElementById('fotoMedida');
        var imagenPreview2 = document.getElementById('preview2');

        // Agregar un evento change al input de carga de archivo
        inputImagen.addEventListener('change', function(event) {
            // Obtener el archivo seleccionado
            var archivo = event.target.files[0];

            // Crear un objeto URL para la imagen seleccionada
            var urlImagen = URL.createObjectURL(archivo);

            // Mostrar la imagen en la vista previa
            imagenPreview.src = urlImagen;
        });

        // Agregar un evento change al segundo input de carga de archivo
        inputImagen2.addEventListener('change', function(event) {
            // Obtener el archivo seleccionado
            var archivo = event.target.files[0];

            // Crear un objeto URL para la imagen seleccionada
            var urlImagen = URL.createObjectURL(archivo);

            // Mostrar la imagen en la vista previa
            imagenPreview2.src = urlImagen;
        });

        //si se selecciona tipo Definición, se muestra el campo para cargar la foto de la medida
        $('#tipo').on('change', function() {
            if (this.value == 'Definición') {
                $('.fotoMedida').show();
            } else {
                $('.fotoMedida').hide();
            }
        });
    </script>
@endsection
