@extends('layouts.app-master')
@section('content')
    <h1>
        @auth
            Bienvenido {{ Auth::user()->name }}!
            <a href="logout">Cerrar sesión</a>
        @else
            Bienvenido Invitado!
            <a href="login">Iniciar sesión</a>
        @endauth


    </h1>
@endsection
