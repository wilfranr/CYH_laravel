@extends('adminlte::page')
@section('title', 'Crear Artículo')

@section('content')
    @component('components.articulo-temporal-form', [
        'articulos' => $articulos,
        'maquinas' => $maquinas,
        'definiciones' => $definiciones,
        'sistemas' => $sistemas,
        'medidas' => $medidas,
        'unidadMedidas' => $unidadMedidas,
        'definicionesFotoMedida' => $definicionesFotoMedida,
    ])
    @endcomponent
@endsection
