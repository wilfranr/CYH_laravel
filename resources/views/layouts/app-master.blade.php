<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    
{{-- scripts --}}
<script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>


</body>

</html>
