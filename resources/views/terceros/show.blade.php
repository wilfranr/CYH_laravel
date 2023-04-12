@extends('layouts.app-master')
@section('title', 'Tercero')

@section('content')
<div>
    <h2>{{ $tercero->nombre }}</h2>
    <p>{{ $tercero->direccion }}</p>
    {{-- <p>{{ $tercero->ciudad->nombre }}, {{ $tercero->ciudad->pais->nombre }}</p> --}}
    <hr>
    {{-- <h3>Contactos:</h3>
    <ul>
        @foreach ($contactos as $contacto)
            <li>{{ $contacto->nombre }} - {{ $contacto->telefono }}</li>
        @endforeach
    </ul> --}}
</div>
@endsection