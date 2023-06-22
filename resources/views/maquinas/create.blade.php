@extends('adminlte::page')
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
                                <label for="tipoMaquina"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tipo de máquina') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="tipo_maquina" name="tipo_maquina">
                                        <option value="">Seleccione un tipo de máquina</option>
                                        @foreach ($tipo_maquina as $t)
                                            <option value="{{ $t->nombre }}">{{ $t->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="marca"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Marca Fabricante') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="marca" name="marca" required>
                                        <option value="">Seleccione una marca fabricante</option>
                                        @foreach ($marca as $m)
                                            <option value="{{ $m->nombre }}">{{ $m->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modelo"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="modelo" id="modelo">
                                        <option value="">Seleccione un modelo</option>
                                        @foreach ($modelo as $mo)
                                            <option value="{{ $mo->nombre }}">{{ $mo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="serie"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Serie') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="serie" id="serie">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="arreglo"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Arreglo') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="arreglo" id="arreglo">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fotoMaquina"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Foto Maquina') }}</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="fotoMaquina" id="fotoMaquina">
                                    <img id="preview" src="#" alt="Vista previa de la imagen"
                                        style="max-width: 200px; max-height: 200px;">
                                    <button id="borrar-foto2" type="button" style="display: none;"
                                        class="btn btn-outline-danger">X</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fotoId"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Foto ID') }}</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="fotoId" id="fotoId">
                                    <img id="preview2" src="#" alt="Vista previa de la imagen"
                                        style="max-width: 200px; max-height: 200px;">
                                    <button id="borrar-foto" type="button" style="display: none;"
                                        class="btn btn-outline-danger">X</button>

                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Crear') }}
                                    </button>
                                    <a href="{{ route('maquinas.index') }}" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Vista previa de la imagen
            document.getElementById("fotoId").addEventListener("change", function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("preview2").src = e.target.result;
                    // Mostrar el botón para borrar la foto
                    var borrarFotoButton = document.getElementById('borrar-foto');
                    borrarFotoButton.style.display = 'block';
                };
                reader.readAsDataURL(e.target.files[0]);
            });
            // Capturar el evento de clic del botón para borrar la foto
            document.getElementById('borrar-foto').addEventListener('click', function() {
                // Limpiar el campo de entrada de archivo y la imagen previsualizada
                var fileInput = document.getElementById('fotoId');
                fileInput.value = '';
                var previewImage = document.getElementById('preview2');
                previewImage.src = '';
                previewImage.style.display = 'none';

                // Ocultar el botón para borrar la foto
                var borrarFotoButton = document.getElementById('borrar-foto');
                borrarFotoButton.style.display = 'none';
            });
        </script>
        <script>
            // Vista previa de la imagen
            document.getElementById("fotoMaquina").addEventListener("change", function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("preview").src = e.target.result;
                    // Mostrar el botón para borrar la foto
                    var borrarFotoButton = document.getElementById('borrar-foto2');
                    borrarFotoButton.style.display = 'block';
                };
                reader.readAsDataURL(e.target.files[0]);
            });
            // Capturar el evento de clic del botón para borrar la foto
            document.getElementById('borrar-foto2').addEventListener('click', function() {
                // Limpiar el campo de entrada de archivo y la imagen previsualizada
                var fileInput = document.getElementById('fotoMaquina');
                fileInput.value = '';
                var previewImage = document.getElementById('preview');
                previewImage.src = '';
                previewImage.style.display = 'none';

                // Ocultar el botón para borrar la foto
                var borrarFotoButton = document.getElementById('borrar-foto2');
                borrarFotoButton.style.display = 'none';
            });
        </script>
</div @endsection
