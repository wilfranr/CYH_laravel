@extends('adminlte::page')
@section('content')
    <h1>
        @auth
            Aca va a ir el contenido de la pagina principal
        @else
            Bienvenido Invitado!
            <a href="login">Iniciar sesión</a>
        @endauth


    </h1>
@endsection
