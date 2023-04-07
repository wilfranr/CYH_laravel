<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CYH IMPORTACIONES</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
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
    <script>
        // Obtener el elemento select
        const tipoDocumentoSelect = document.getElementById('tipo_documento');
        // Obtener el campo dv
        const dvField = document.getElementById('dv-field');
        // Agregar evento onchange al select
        tipoDocumentoSelect.addEventListener('change', function() {
            // Si la opción seleccionada es NIT, mostrar el campo dv
            dvField.style.display = tipoDocumentoSelect.value === 'NIT' ? 'block' : 'none';
        });
        console.log(tipoDocumentoSelect);
    </script>

</body>

</html>
