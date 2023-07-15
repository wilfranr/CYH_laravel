@extends('adminlte::page')

@section('content')
    <div class="mt-3 mb-5">
        <h4>
            <span class="badge badge-warning"><i class="fas fa-shopping-cart"></i>Pedido #{{ $pedido->id }}</span>
            <small class="float-right">Fecha de pedido: {{ $pedido->created_at }}</small><br>
            <small class="float-right">Vendedor: {{ $pedido->user->name }} <a
                    href="https://wa.me/+57{{ $pedido->user->phone }}" target="_blank"><i
                        class="fab fa-whatsapp"></i></a></small><br>

        </h4>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- info pedido -->
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                Datos del cliente
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-3">
                        <p>Cliente</p>
                        <input type="hidden" name="tercero_id" id="tercero_id" value="{{ $pedido->tercero->id }}" readonly>
                        <input type="hidden" name="user_id" id="user_id" value="{{ $pedido->user->id }}">
                        <input type="hidden" name="estado" id="estado" value="Costeo">
                        <input type="hidden" name="comentario" id="comentario" value="{{ $pedido->comentario }}">
                        <input type="hidden" name="contacto_id" id="contacto_id" value="{{ $pedido->contacto->id }}">
                        <input type="hidden" name="maquina_id" id="maquina_id"
                            value="{{ $pedido->maquinas->first()->id }}">
                        <h2 class="lead"><b><strong>{{ $pedido->tercero->nombre }}</strong></b></h2>
                        <p class="text-muted text-sm">
                            <b>
                                @if ($pedido->tercero->tipo_documento == 'cedula')
                                    <span class=""><i class="fas fa-lg fa-id-card"></i> CC:</span>
                                @elseif ($pedido->tercero->tipo_documento == 'nit')
                                    <span class=""><i class="fas fa-lg fa-id-card"></i> NIT:</span>
                                @elseif ($pedido->tercero->tipo_documento == 'ce')
                                    <span class=""><i class="fas fa-lg fa-id-card"></i> CE:</span>
                                @endif
                            </b> {{ $pedido->tercero->numero_documento }}
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fas fa-lg fa-building"></i> Dirección:</span>
                            </b> {{ $pedido->tercero->direccion }}
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fab fa-2x fa-whatsapp"></i> Teléfono:</span>
                            </b>
                            <a href="https://wa.me/+57{{ $pedido->tercero->telefono }}" target="_blank">
                                {{ $pedido->tercero->telefono }}
                            </a>
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fa fa-lg fa-envelope"></i> Email:</span>
                            </b>
                            <a href="mailto:{{ $pedido->tercero->email }}" target="_blank">
                                {{ $pedido->tercero->email }}
                            </a>
                        </p>
                    </div>
                    <div class="col-3">
                        <p>Contacto del cliente</p>
                        <h2 class="lead">
                            <b>
                                <strong>
                                    @if ($pedido->contacto)
                                        {{ $pedido->contacto->nombre }}
                                    @else
                                        N/A
                                    @endif
                                </strong>
                            </b>
                        </h2>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fab fa-2x fa-whatsapp"></i> Teléfono:</span>
                            </b>
                            @if ($pedido->contacto)
                                <a href="https://wa.me/+57{{ $pedido->contacto->telefono }}" target="_blank">
                                    {{ $pedido->contacto->telefono }}
                                @else
                                    N/A
                            @endif
                            </a>
                        </p>
                        <p class="text-muted text-sm">
                            <b>
                                <span class=""><i class="fa fa-lg fa-envelope"></i> Email:</span>
                            </b>
                            @if ($pedido->contacto)
                                <a href="mailto:{{ $pedido->contacto->email }}">
                                    {{ $pedido->contacto->email }}
                                </a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="col-3">
                        <p>Maquinas asociadas al pedido</p>
                        @if ($pedido->maquinas->count() >= 1)
                            <h2 class="lead">
                                <strong>
                                    @foreach ($pedido->maquinas as $maquina)
                                        <ul>
                                            <li>
                                                <b>
                                                    <i class="fa fa-wrench"></i>
                                                    {{ $maquina->tipo }} <a
                                                        href="{{ route('maquinas.show', $maquina->id) }}" target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a><br>
                                                </b>
                                                <p>{{ $maquina->marca }}</p>
                                                <p>{{ $maquina->modelo }}</p>


                                            </li>
                                        </ul>
                                    @endforeach
                                </strong>

                            </h2>


                    </div>
                    <div class="col-3 text-center">
                        <img src="{{ asset('storage/maquinas/' . $maquina->foto) }}" alt="user-avatar"
                            class="img-circle img-fluid">
                    </div>
                @else
                    N/A
                    @endif
                </div>
                <div>
                    Comentarios del pedido: <br>
                    <textarea class="form-control" disabled>{{ $pedido->comentario }}</textarea>

                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="https://wa.me/+57{{ $pedido->tercero->telefono }}" class="btn btn-sm bg-teal" target="_blank">
                        <i class="fas fa-comments"></i>
                    </a>
                    <a href="{{ route('terceros.show', $pedido->tercero->id) }}" class="btn btn-sm btn-primary"
                        target="_blank">
                        <i class="fas fa-user"></i> Ver tercero
                    </a>
                </div>
            </div>
        </div>

        <!-- Calendar -->
        @foreach ($pedido->articulosTemporales as $index => $articuloTemporal)
            <div class="card bg-gradient-secondary">
                <div class="card-header border-0">

                    <h3 class="card-title text-uppercase">
                        <i class="fa fa-boxes"></i>
                        {{ $articuloTemporal->definicion }}
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-warning btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <a href="" class="btn btn-warning btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                    <!--Tabla de articulos y proveedores -->
                    <div id="" style="width: 100%">
                        <table id="articulos" class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 45%;">Referencia</th>
                                    <th style="width: 10%;">Cantidad</th>
                                    <th style="width: 30%;">Comentarios</th>
                                    <th style="width: 10%;">Imágen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <input type="text" value="{{ $articuloTemporal->referencia }}"
                                                class="form-control" name="referencia{{ $index + 1 }}" disabled>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="cantidad{{ $index + 1 }}"
                                            value="{{ $articuloTemporal->cantidad }}" disabled>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="comentarios{{ $index + 1 }}" disabled>{{ $articuloTemporal->comentarios }}</textarea>
                                    </td>
                                    <!-- Aca va la foto del articulo temporal -->
                                    @if ($articuloTemporal->fotosArticuloTemporal->count() > 0)
                                        <td>
                                            <a href="{{ asset('storage/fotos-articulo-temporal/' . $articuloTemporal->fotosArticuloTemporal->first()->foto_path) }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/fotos-articulo-temporal/' . $articuloTemporal->fotosArticuloTemporal->first()->foto_path) }}"
                                                    alt="Foto del artículo" width="50px">
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <img src="{{ asset('storage/fotos-articulo-temporal/no-imagen.jpg') }}"
                                                alt="Foto del artículo" width="50px">
                                        </td>
                                    @endif

                                </tr>
                            </tbody>
                        </table>
                        {{-- Tabla con proveedores --}}
                        <table id="proveedores" class="table table-bordered table-striped mt-3">
                            <h5>Proveedores</h5>
                                <span class="badge bg-info">Nacionales</span>
                                <span class="badge bg-secondary">Internacionales</span>
                            <thead class="table-dark">
                                <tr>
                                    <th>Proveedor</th>
                                    <th>Marca</th>
                                    <th>Entrega</th>
                                    <th>Cantidad</th>
                                    <th>Peso(lbs)</th>
                                    <th>Costo $Us</th>
                                    <th>Costo $Col</th>
                                    <th>Utilidad</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-info">
                                    <td>
                                        <div class="d-flex">
                                            <select name="proveedor{{ $index + 1 }}"
                                                id="proveedor{{ $index + 1 }}" class="form-control">
                                                @foreach ($proveedoresNacionales as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-control" name="marca" id="marca">
                                            @foreach ($proveedor->marcas as $marca)
                                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="entrega" id="entrega-nacional" class="form-control">
                                            <option value="">Selecione...</option>
                                            <option value="inmediata">Inmediata</option>
                                            <option value="programada">Programada</option>
                                        </select>
                                        <input type="text" name="dias-nacional" id="dias-nacional" placeholder="Días para entrega">
                                    </td>
                                    <td>
                                        {{-- Cantidad --}}
                                        <input type="number" class="form-control" name="cantidad" value="{{ $articuloTemporal->cantidad }}">
                                    </td>
                                    <td>
                                        {{-- peso --}}
                                        <input type="text" class="form-control" name="peso" value="">
                                    </td>
                                    <td>
                                        {{-- costo_Us --}}
                                        <input type="text" class="form-control bg-secondary" name="costo_Us" value="" disabled>
                                    </td>
                                    <td>
                                        {{-- costo_Col --}}
                                        <input type="text" class="form-control" name="costo_Col" value="">
                                    </td>
                                    <td>
                                        {{-- Utilidad --}}
                                        <input type="text" class="form-control" name="utilidad" value="">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger btn-sm delete-row-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="table-secondary">
                                    <td>
                                        <div class="d-flex">
                                            <select name="proveedor{{ $index + 1 }}"
                                                id="proveedor{{ $index + 1 }}" class="form-control">
                                                @foreach ($proveedoresInternacionales as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-control" name="marca" id="marca">
                                            @foreach ($proveedor->marcas as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="entrega" id="entrega-internacional" class="form-control">
                                            <option value="">Selecione...</option>
                                            <option value="inmediata">Inmediata</option>
                                            <option value="programada">Programada</option>
                                        </select>
                                        <input type="text" name="dias-internacional" id="dias-internacional" placeholder="Días para entrega">

                                    </td>
                                    <td>
                                        {{-- Cantidad --}}
                                        <input type="number" class="form-control" name="cantidad" value="{{ $articuloTemporal->cantidad }}">
                                    </td>
                                    <td>
                                        {{-- peso --}}
                                        <input type="text" class="form-control" name="peso" value="">
                                    </td>
                                    <td>
                                        {{-- costo_Us --}}
                                        <input type="text" class="form-control" name="costo_Us" value="">
                                    </td>
                                    <td>
                                        {{-- costo_Col --}}
                                        <input type="text" class="form-control bg-secondary" name="costo_Col" value="" disabled>
                                    </td>
                                    <td>
                                        {{-- Utilidad --}}
                                        <input type="text" class="form-control" name="utilidad" value="">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger btn-sm delete-row-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        @endforeach

        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Enviar cotización</button>
        <a href="{{ route('costeos.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
        
    </form>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        //ocultar input dias
        $('#dias-nacional').hide();
        $('#dias-internacional').hide();
        //si entrega es programada mostrar un input para ingresar cantidad de dias
        $('#entrega-nacional').on('change', function() {
            if (this.value == 'programada') {
                $('#dias-nacional').show();
            } else {
                $('#dias-nacional').hide();
            }
            
        });
        $('#entrega-internacional').on('change', function() {
            if (this.value == 'programada') {
                $('#dias-internacional').show();
            } else {
                $('#dias-internacional').hide();
            }
        });
    });
</script>
@endsection