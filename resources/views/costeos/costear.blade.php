@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Pedido #{{ $pedido->id }}</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Cliente:</strong> {{ $pedido->tercero_id ? $pedido->tercero->nombre : 'N/A' }}</p>
                    <p><strong>Vendedor:</strong> {{ $pedido->user ? $pedido->user->name : 'N/A' }}</p>
                    <p><strong>Contacto:</strong> {{ $pedido->contacto ? $pedido->contacto->nombre : 'N/A' }}</p>
                    @if ($pedido->contacto)
                        @if ($pedido->contacto->telefono)
                            <p><strong>Teléfono Contacto:</strong> <a
                                    href="https://wa.me/+57{{ $pedido->contacto->telefono }}">{{ $pedido->contacto->telefono }}</a>
                            </p>
                        @else
                            <p><strong>Teléfono:</strong> N/A</p>
                        @endif
                    @endif
                </div>
                <div class="col-md-6">
                    <p><strong>Comentario:</strong> {{ $pedido->comentario ?? 'N/A' }}</p>
                    <p><strong>Estado:</strong> {{ $pedido->estado ?? 'N/A' }}</p>
                </div>
            </div>

            <hr>

            <h3>Máquinas asociadas</h3>
            @if (count($pedido->maquinas) > 0)
                <ul>
                    @foreach ($pedido->maquinas as $maquina)
                        <li>{{ $maquina->tipo }}</li>
                    @endforeach
                </ul>
            @else
                <p>No hay máquinas asociadas a este pedido.</p>
            @endif
        </div>
    </div>


    <div class="">
        <h2>Artículos </h2>
        {{-- Mostrar articulos relacionados con el pedido --}}
        @foreach ($pedido->articulos as $index => $articulo)
            <div class="border border-warning mb-3 p-3">
                <h4>Artículo {{ $index + 1 }}</h4>
                <a href="{{ route('articulos.show', $articulo->id) }}" class="btn btn-sm btn-primary"
                    target="_blank">Ver</a>

                <div class="row">
                    <div class="col-md-4">
                        <p>Referencia: {{ $articulo->referencia }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Definición: {{ $articulo->definicion }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Cantidad: {{ $articulo->pivot->cantidad }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>Comentarios: {{ $articulo->comentarios }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{-- agregar un botón que elimine la relación de articulo_pedido --}}
                        <form action="{{ route('pedidos.detachArticulo', [$pedido->id, $articulo->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Ver proveedores con articulo disponible --}}
        <h2>Proveedores</h2>
        <div class="d-flex flex-wrap">
            @foreach ($proveedores as $proveedor)
                <div class="border border-warning mb-3 p-3">
                    <h4>Proveedor {{ $proveedor->id - 1 }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Nombre: {{ $proveedor->nombre }}</p>
                            <label for="marca" class="form-label">Marca</label>
                            <select class="form-control" name="marca" id="marca">
                                @foreach ($proveedor->marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="entrega" class="form-label">Entrega</label>
                            <select class="form-control" name="entrega" id="entrega">
                                <option value="inmediata">Inmediata</option>
                                <option value="programada">Programada</option>
                            </select>
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control">
                            <label for="peso" class="form-label">Peso(lbs)</label>
                            <input type="text" class="form-control">
                            <label for="costo_us" class="form-label">Costo $Us</label>
                            <input type="text" class="form-control">
                            <label for="costo_col" class="form-label">Costo $Col</label>
                            <input type="text" class="form-control" placeholder="(Peso X 2.15+costoUS)*TRM">
                            
                            <label for="utilidad" class="form-label">Utilidad</label>
                            <input type="text" class="form-control" >
                            <button type="button" class="btn btn-outline-primary">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>





        <form action="{{ route('pedidos.cambiarEstado', $pedido->id) }}" method="POST">
            @csrf
            @method('PUT')


            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="tercero_id" value="{{ $pedido->tercero_id }}">


            <input type="hidden" name="estado" value="Costeo">
            <button type="submit">Enviar Cotización</button>
        </form>



    </div>

@endsection
