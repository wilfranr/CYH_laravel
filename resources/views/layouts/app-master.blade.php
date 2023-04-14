<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CYH IMPORTACIONES</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    {{-- Components --}}
    <x-navbar />
    {{-- Contenido --}}
    <main class="container">
        @yield('content')

    </main>
    {{-- Scripts --}}
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        
        // Obtener el elemento select
        const tipoDocumentoSelect = document.getElementById('tipo_documento');
        // Obtener el campo dv
        const dvField = document.getElementById('dv-field');
        // Agregar evento onchange al select
        tipoDocumentoSelect.addEventListener('change', function() {
            // Si la opción seleccionada es NIT, mostrar el campo dv
            dvField.style.display = tipoDocumentoSelect.value === 'nit' ? 'block' : 'none';
        });

        const paisSelect = document.getElementById('pais_id');
        paisSelect.addEventListener('change', function() {
            const paisCodigo = this.value;
            fetch('/ciudades/' + paisCodigo)
                .then(response => response.json())
                .then(data => {
                    const ciudadSelect = document.getElementById('ciudad');
                    
                    ciudadSelect.innerHTML = '';
                    data.ciudades.forEach(ciudad => {
                        const option = document.createElement('option');
                        option.value = ciudad.CiudadID;
                        option.text = ciudad.CiudadNombre;
                        ciudadSelect.appendChild(option);
                        
                    });
                });
        });
        $(document).ready(function () {
        let contadorContactos = 2;

        $('#agregar-contacto').on('click', function () {
            $('#contactos').append(`
                <hr>
                <div class="form-group">
                    <label for="nombre_contacto_${contadorContactos}">Nombre:</label>
                    <input type="text" name="nombre_contacto_${contadorContactos}" id="nombre_contacto_${contadorContactos}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telefono_contacto_${contadorContactos}">Teléfono:</label>
                    <input type="text" name="telefono_contacto_${contadorContactos}" id="telefono_contacto_${contadorContactos}" class="form-control">
                </div>
            `);

            contadorContactos++;
        });
    });
        
        
    </script>


</body>

</html>
