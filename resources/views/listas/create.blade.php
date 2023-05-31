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
            <div class="form-group fotoMedida">
                <label for="fotoMedida">Foto Medida:</label>
                <input type="file" class="form-control" name="fotoMedida" id="fotoMedida">
                
            </div>
            <button type="submit" class="btn btn-primary">Crear Lista</button>
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

                    // Boton para remover foto
                    var botonRemover = document.createElement('button');
                    botonRemover.classList.add('btn', 'btn-danger');
                    botonRemover.textContent = 'X';
                    botonRemover.type = 'button';
                    botonRemover.addEventListener('click', function() {
                        imagenPreview.src = '#';
                        inputImagen.value = '';
                        botonRemover.remove();
                    });
                    imagenPreview.insertAdjacentElement('afterend', botonRemover);
                }

                // Leer el archivo seleccionado como una URL de datos
                reader.readAsDataURL(inputImagen.files[0]);
            }
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
