@extends('layouts.app-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ __('Crear Máquina') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('maquinas.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="tipoMaquina" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de máquina') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="tipo_maquina" name="tipo_maquina">
                                    <option value="">Seleccione un tipo de máquina</option>
                                    @foreach($tipo_maquina as $t)
                                        <option value="{{ $t->nombre }}">{{ $t->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca Fabricante') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="marca" name="marca" required>
                                    <option value="">Seleccione una marca fabricante</option>
                                    @foreach($marca as $m)
                                        <option value="{{ $m->nombre }}">{{ $m->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="modelo" id="modelo">
                                    <option value="">Seleccione un modelo</option>
                                    @foreach($modelo as $mo)
                                        <option value="{{ $mo->nombre }}">{{ $mo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serie" class="col-md-4 col-form-label text-md-right">{{__('Serie')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="serie" id="serie" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arreglo" class="col-md-4 col-form-label text-md-right">{{__('Arreglo')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="arreglo" id="arreglo" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fotoMaquina" class="col-md-4 col-form-label text-md-right">{{__('Foto Maquina')}}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="fotoMaquina" id="fotoMaquina" >
                                <img id="preview" src="#" alt="Vista previa de la imagen"
                                    style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fotoId" class="col-md-4 col-form-label text-md-right">{{__('Foto ID')}}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="fotoId" id="fotoId" >
                                <img id="preview2" src="#" alt="Vista previa de la imagen"
                                    style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear') }}
                                </button>
                                <a href="{{  route('maquinas.index')}}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            // Obtener el elemento del input de carga de archivo y el elemento de la vista previa
            var inputImagen = document.getElementById('fotoMaquina');
            var inputImagen2 = document.getElementById('fotoId');
            var imagenPreview = document.getElementById('preview');
            var imagenPreview2 = document.getElementById('preview2');

            // Agregar un evento de cambio al input de carga de archivo
            inputImagen.addEventListener('change', function() {
                // Verificar si se seleccionó un archivo
                if (inputImagen.files && inputImagen.files[0]) {
                    // Crear un objeto FileReader para leer el archivo
                    var reader = new FileReader();

                    // Configurar la función de carga del FileReader
                    reader.onload = function(e) {
                        // Asignar la imagen cargada a la vista previa
                        imagenPreview.src = e.target.result;
                    }

                    // Leer el archivo seleccionado como una URL de datos
                    reader.readAsDataURL(inputImagen.files[0]);
                }
                if (inputImagen2.files && inputImagen2.files[0]) {
                    // Crear un objeto FileReader para leer el archivo
                    var reader = new FileReader();

                    // Configurar la función de carga del FileReader
                    reader.onload = function(e) {
                        // Asignar la imagen cargada a la vista previa
                        imagenPreview2.src = e.target.result;
                    }

                    // Leer el archivo seleccionado como una URL de datos
                    reader.readAsDataURL(inputImagen2.files[0]);
                }
            });

            
    </script>
</div
@endsection