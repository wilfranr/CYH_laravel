@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('articulos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">{{ __('Crear artículo') }}</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="marca"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Marca fabricante') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-select" id="marca" name="marca">
                                            <option value="">Seleccione una marca fabricante</option>
                                            @foreach ($maquinas as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="tipo_maquina"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Tipo de maquina') }}</label>
                    
                                    <div class="col-md-6">
                                        <select class="form-control" id="tipo_maquina" name="tipo_maquina">
                                            <option value="">Seleecione una máquina</option>
                                            @foreach ($maquinas as $maquina)
                                            <option value="{{ $maquina->id }}">{{ $maquina->tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row">
                                    <label for="sistema"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Sistema') }}</label>
                    
                                    <div class="col-md-6">
                                        <select name="sistema" id="sistema" class="form-control">
                                            <option value="">Seleccione un sistema</option>
                                            @foreach ($sistemas as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label for="definicion"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Definición') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-select" id="definicion" name="definicion">
                                            <option value="">Seleccione una descripción común</option>
                                            @foreach ($definiciones as $id => $nombre)
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
                                            class="form-control @error('referencia') is-invalid @enderror" name="referencia"
                                            value="{{ old('referencia') }}" required>

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
                                            name="descripcion_especifica" value="{{ old('descripcion_especifica') }}"
                                            required>

                                        @error('descripcion_especifica')
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
                                            class="form-control @error('peso') is-invalid @enderror" name="peso"
                                            value="{{ old('peso') }}">

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
                                            class="form-control">
                                            <img id="preview2" src="#" alt="Vista previa de la imagen"
                                    style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                                {{-- Foto medida --}}
                                <div class="form-group row">
                                    <label for="foto-medida"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Foto de medidas') }}</label>

                                    <div class="col-md-6">
                                        <input type="file" name="foto-medida" id="foto-medida" class="form-control">
                                        <img id="preview" src="#" alt="Vista previa de la imagen"
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
                                            name="Cambio (Referencia)" value="{{ old('Cambio (Referencia)') }}">

                                        @error('Cambio (Referencia)')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>


                                </div>
                                <div class="form-group row">
                                    <label for="juego"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Hace parte de:') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="juego[]" multiple="multiple">
                                            @foreach ($articulos as $articulo)
                                                <option value="{{ $articulo['id'] }}">{{ $articulo['referencia'] }}
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
                    <div class="col-md-6">
                        <div id="medidas">
                            <input type="hidden" name="contadorMedidas" value="2">

                        </div>

                        <button type="button" class="btn btn-success" id="agregar-medida">Agregar medida</button>

                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary mt-3">Crear</button>
                            <a href="{{ route('articulos.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Agregar enlaces al archivo JS y CSS de Dropzone -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>


    <script>
        $(document).ready(function() {
            let contadorMedidas = 1;
            $('#agregar-medida').on('click', function() {
                $('#medidas').append(`
                    <div class="card">
                            <div class="card-header">{{ __('Medidas') }}</div>
                            <div class="card-body">
                                
                                <div class="form-group row">
                                    <label for="tipoMedida"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Tipo de medida') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-select" id="tipoMedida" name="tipoMedida">
                                            <option value="">Seleccione un tipo de medida</option>
                                            @foreach ($medidas as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valorMedida"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Valor medida') }}</label>

                                    <div class="col-md-6">
                                        <input id="valorMedida" type="text"
                                            class="form-control @error('valorMedida') is-invalid @enderror"
                                            name="valorMedida" value="{{ old('valorMedida') }}" >

                                        @error('valorMedida')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <select class="form-select" id="unidadMedida" name="unidadMedida">
                                            <option value="">Unidad de medida</option>
                                            @foreach ($unidadMedidas as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="idMedida"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Id Medida') }}</label>

                                    <div class="col-md-6">
                                        <input id="idMedida" type="text"
                                            class="form-control @error('idMedida') is-invalid @enderror" name="idMedida"
                                            value="{{ old('id_medida') }}" >

                                        @error('idMedida')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

            `);

                contadorMedidas++;
            });

            
        });
        
    </script>
    <script>
        // Vista previa de la imagen
        document.getElementById("foto-medida").addEventListener("change", function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview").src = e.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
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

@endsection
