@extends('layouts.app-master')
@section('content')
    <h1>
        @auth
            Bienvenido {{ auth()->user()->name }}
            <a href="logout">Cerrar sesión</a>
        @endauth
        @guest
            Bienvenido invitado
            <a href="login">Iniciar sesión</a>
        @endguest
    </h1>
    
@endsection
    