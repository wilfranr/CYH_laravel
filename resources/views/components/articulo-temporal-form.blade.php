@props(['articulos', 'maquinas', 'definiciones', 'sistemas', 'medidas', 'unidadMedidas', 'definicionesFotoMedida', 'pedido'])

<!-- Resto del código del componente -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Artículos</h3>
                    </div>
                    {{-- Aca va el formulario --}}
                    <form method="POST" action="{{ route('articulos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">{{ __('Datos de artículo') }}</div>
                                    <div class="card-body">
                                        <input type="hidden" value="{{ isset($pedido) ? $pedido->id : '' }}"
                                            name="pedido_id">


                                        <div class="form-group row">
                                            <label for="select-definicion"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Definición') }}</label>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col">
                                                        <select class="form-control" id="select-definicion"
                                                            name="select-definicion"
                                                            onchange="mostrarFotoMedida(this.value)" required>
                                                            <option value="">Seleccione una definición</option>
                                                            @foreach ($definiciones as $id => $nombre)
                                                                <option value="{{ $nombre }}">{{ $nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="btn-crear-deficion">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="divCrearDefinicion">
                                            <div class="col-md-9">
                                                @component('components.crear-lista-form')
                                                @endcomponent
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="marca"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Marca fabricante') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control" id="marca" name="marca">
                                                    <option value="">Seleccione una marca fabricante</option>
                                                    @foreach ($maquinas as $id => $nombre)
                                                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="referencia"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Referencia') }}</label>

                                            <div class="col-md-6">
                                                <input id="referencia" type="text"
                                                    class="form-control @error('referencia') is-invalid @enderror"
                                                    name="referencia" value="{{ old('referencia') }}" required>

                                                @error('referencia')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="descripcion_especifica"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Descripción específica') }}</label>

                                            <div class="col-md-6">
                                                <input id="descripcion_especifica" type="text"
                                                    class="form-control @error('descripcion_especifica') is-invalid @enderror"
                                                    name="descripcion_especifica"
                                                    value="{{ old('descripcion_especifica') }}" required>

                                                @error('descripcion_especifica')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- cantidad int --}}
                                        <div class="form-group row">
                                            <label for="cantidad"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Cantidad') }}</label>

                                            <div class="col-md-6">
                                                <input id="cantidad" type="number"
                                                    class="form-control @error('cantidad') is-invalid @enderror"
                                                    name="cantidad" value="{{ old('cantidad') }}" required
                                                    min="1">

                                                @error('cantidad')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="comentarios"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Comentarios') }}</label>

                                            <div class="col-md-6">
                                                <textarea id="comentarios" class="form-control @error('comentarios') is-invalid @enderror" name="comentarios">{{ old('comentarios') }}</textarea>

                                                @error('comentarios')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="peso"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Peso (lbs)') }}</label>

                                            <div class="col-md-6">
                                                <input id="peso" type="text"
                                                    class="form-control @error('peso') is-invalid @enderror"
                                                    name="peso" value="{{ old('peso') }}">

                                                @error('peso')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Foto descriptiva --}}
                                        <div class="form-group row">
                                            <label for="foto-descriptiva"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Foto descriptiva') }}</label>

                                            <div class="col-md-6">
                                                <input type="file" name="foto-descriptiva" id="foto-descriptiva"
                                                    class="custom-file-input">
                                                    <label class="custom-file-label" for="exampleInputFile">Seleccionar imágen</label>
                                                <img id="preview2" src="#" alt="Vista previa de la imagen"
                                                    style="max-width: 200px; max-height: 200px;">
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>

                                <div class="card mb-5">
                                    <div class="card-header">{{ __('Modelos juegos y cruces') }}</div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="cambio"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Cambio (Referencia)') }}</label>

                                            <div class="col-md-6">
                                                <input id="cambio" name="cambio" type="text"
                                                    class="form-control @error('Cambio (Referencia)') is-invalid @enderror"
                                                    name="Cambio (Referencia)"
                                                    value="{{ old('Cambio (Referencia)') }}">

                                                @error('Cambio (Referencia)')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="juego"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Componentes:') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="juego[]" multiple="multiple">
                                                    @foreach ($articulos as $articulo)
                                                        <option value="{{ $articulo['id'] }}">
                                                            {{ $articulo['referencia'] }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('juego')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>


                                        </div>

                                    </div>

                                </div>

                            </div>
                            {{-- Segunda columna --}}
                            <div class="col-md-4">
                                <div id="medidas">
                                    <input type="hidden" name="contadorMedidas" value="1">
                                    <div>
                                        <label for="fotMedida3">Foto de la Medida:</label>
                                        <a href="" target="_blank" id="link-foto-medida">
                                            <img id="fotoMedida3" src="{{ asset('storage/listas') }}/no-imagen.jpg"
                                                alt="Foto de medida" width="300px">
                                        </a>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success" id="agregar-medida">Agregar
                                    medida</button>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary mt-3">Crear</button>
                                        {{-- boton para volver a articulos.index --}}
                                        <a href="{{ route('articulos.index') }}" class="btn btn-danger mt-3">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    function mostrarFotoMedida(definicionId) {
        console.log(definicionId);
        var definicionesFotoMedida = @json($definicionesFotoMedida);
        console.log(definicionesFotoMedida);
        var fotoMedida = "{{ asset('storage/listas') }}/" + (definicionId && definicionId in definicionesFotoMedida ?
            definicionesFotoMedida[definicionId] : 'no-imagen.jpg');
        console.log(fotoMedida);
        $('#fotoMedida3').attr('src', fotoMedida);
        $('#link-foto-medida').attr('href', fotoMedida);


    }
</script>

<script>
    $(document).ready(function() {

        let contadorMedidas = 1;
        $('#agregar-medida').on('click', function() {
            $('#medidas').append(`
                <div class="card">
                        <div class="card-header">{{ __('Medidas') }}</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tipoMedida" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de medida') }}</label>
                                    <select class="form-control" id="tipoMedida${contadorMedidas}" name="tipoMedida[]">

                                        <option value="">Seleccione un tipo de medida</option>
                                        @foreach ($medidas as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="valorMedida" class="col-md-4 col-form-label text-md-right">{{ __('Valor medida') }}</label>

                                <div class="col-md-6">
                                    <input id="valorMedida" type="text" class="form-control @error('valorMedida') is-invalid @enderror"
                                        name="valorMedida[]" value="{{ old('valorMedida') }}">

                                    @error('valorMedida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <select class="form-control" id="unidadMedida" name="unidadMedida[]">
                                        <option value="">Unidad de medida</option>
                                        @foreach ($unidadMedidas as $id => $nombre)
                                            <option value="{{ $nombre }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="idMedida" class="col-md-4 col-form-label text-md-right">{{ __('Id Medida') }}</label>

                                <div class="col-md-6">
                                    <input id="idMedida" type="text" class="form-control @error('idMedida') is-invalid @enderror"
                                        name="idMedida[]" value="{{ old('id_medida') }}">

                                    @error('idMedida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            contadorMedidas++;
        });
        //Ocultar boton de agregar medida
        $('#agregar-medida').hide();
        // Mostrar boton de agregar medida si se selecciona una definicion
        $('#select-definicion').on('change', function() {
            $('#agregar-medida').show();
            // Obtener referencias a los elementos select e imagen
        });
        //ocultar div crear definición
        $('#divCrearDefinicion').hide();
        // Mostrar div crear definición si se selecciona la opción +
        $('#btn-crear-deficion').on('click', function() {
            $('#divCrearDefinicion').show();
        });
        //ocultar div al seleccionar una definición
        $('#select-definicion').on('change', function() {
            $('#divCrearDefinicion').hide();
        });

    });
</script>

<script>
    // Vista previa de la imagen
    document.getElementById("foto-descriptiva").addEventListener("change", function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("preview2").src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
