@extends('adminlte::page')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Editar Pedido #{{ $pedido->id }}</h1>
        
        <form action="{{ route('pedidos.update', ['id' => $pedido->id]) }}" method="POST">
            @csrf
            @method('PUT')
        
            {{-- Campos de edición del pedido --}}
            {{-- ... --}}
            <div class="form-group">
                <label for="tercero">Cliente:</label>
                <input type="text" name="tercero" id="tercero" class="form-control" value="{{ $pedido->tercero->nombre }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="vendedor">Vendedor:</label>
                <input type="text" name="vendedor" id="vendedor" class="form-control" value="{{ $pedido->user->name }}"
                    readonly>
            </div>
            <div class="form-group mb-5">
                <label for="contacto">Contacto:</label>
                <input type="text" name="contacto" id="contacto" class="form-control"
                    value="{{ $pedido->contacto->nombre }}" readonly>
                    <label for="telefonoContacto">Telefono</label>
                    <a href="https://wa.me/{{ $pedido->contacto->telefono }}">{{ $pedido->contacto->telefono }}</a>
            </div>

            <!-- Campo de máquinas no editable -->
            <div class="form-group mb-5">
                <label for="maquinas">Máquinas:</label>
                <ul>
                    @foreach ($pedido->maquinas as $maquina)
                        <li>{{ $maquina->tipo }}</li>
                    @endforeach
                </ul>
            </div>
        
            <h2>Artículos temporales</h2>
            @foreach ($articulosTemporales as $index => $articuloTemporal)
                <div class="articulo-temporal">
                    <h4>Artículo {{ $index + 1 }}</h4>
                    <div class="form-group">
                        <label for="referencia{{ $index }}">Referencia</label>
                        <input type="text" name="articulos_temporales[{{ $index }}][referencia]" value="{{ $articuloTemporal->referencia }}">
                    </div>
                    <div class="form-group">
                        <label for="definicion{{ $index }}">Definición</label>
                        <input type="text" name="articulos_temporales[{{ $index }}][definicion]" value="{{ $articuloTemporal->definicion }}">
                    </div>
                    <div class="form-group">
                        <label for="sistema{{ $index }}">Sistema</label>
                        <input type="text" name="articulos_temporales[{{ $index }}][sistema]" value="{{ $articuloTemporal->sistema }}">
                    </div>
                    <div class="form-group">
                        <label for="cantidad{{ $index }}">Cantidad</label>
                        <input type="number" name="articulos_temporales[{{ $index }}][cantidad]" value="{{ $articuloTemporal->cantidad }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="comentarios{{ $index }}">Comentarios</label>
                        <input type="text" name="articulos_temporales[{{ $index }}][comentarios]" value="{{ $articuloTemporal->comentarios }}">
                    </div>

                    <input type="hidden" name="estado" id="estado" value="Procesando">
                    <!-- Mostrar otros campos si es necesario -->
                </div>
            @endforeach
        
            {{-- Agregar más campos de artículo temporal si se desea --}}
            {{-- ... --}}
        
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
        
    </div>
@endsection
