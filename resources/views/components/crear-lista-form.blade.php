<div class="container">
    <form id="formulario-definicion" enctype="multipart/form-data">

        @csrf

        <input type="hidden" id="tipo" name="tipo" value="Definición">
       

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" >
        </div>
        <div class="form-group">
            <label for="definicion">Definición:</label>
            <textarea class="form-control" name="definicion" id="definicion" ></textarea>
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
    </form>
    <button type="button" id="guardar-definicion" class="btn btn-primary">Crear</button>
</div>
<!-- Incluye la librería de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

    // guardar definicion
    $('#guardar-definicion').click(function() {
        // Obtener los valores de los campos del formulario
        var tipo = $('#tipo').val();
        var nombre = $('#nombre').val();
        var definicion = $('#definicion').val();

        // Obtener el archivo de imagen seleccionado
        var fotoLista = $('#fotoLista')[0].files[0];
        var fotoMedida = $('#fotoMedida')[0].files[0];

        // Crear el objeto FormData y agregar los valores y archivos
        var formData = new FormData();
        formData.append('tipo', tipo);
        formData.append('nombre', nombre);
        formData.append('definicion', definicion);
        formData.append('fotoLista', fotoLista);
        formData.append('fotoMedida', fotoMedida);

        // realizar solicitud ajax
        $.ajax({

            url: "{{ route('articulos.definicion') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                // recargar pagina actual
                location.reload();
                
                

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
