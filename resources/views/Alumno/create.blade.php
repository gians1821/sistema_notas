@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Registro de Alumnos -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="h3 mb-3 text-left"><strong>Registro</strong> Nuevo</h1>
                <form method="POST" action="{{ route('Alumno.store') }}">
                    @csrf
                    <div class="row">
                        <!-- Campos alineados a la izquierda -->
                        <div class="col-md-6">
                            @include('components.text_input', [
                                'name' => 'nombre_alumno',
                                'label' => 'Nombre',
                            ])
                            @include('components.text_input', [
                                'name' => 'apellido_alumno',
                                'label' => 'Apellido',
                            ])
                            @include('components.date_input', [
                                'name' => 'fecha_nacimiento',
                                'label' => 'Fecha de Nacimiento',
                            ])
                            @include('components.text_input', [
                                'name' => 'dni',
                                'label' => 'DNI',
                            ])
                            @include('components.text_input', [
                                'name' => 'pais',
                                'label' => 'País',
                            ])
                            @include('components.text_input', [
                                'name' => 'region',
                                'label' => 'Región',
                            ])
                            @include('components.text_input', [
                                'name' => 'ciudad',
                                'label' => 'Ciudad',
                            ])
                        </div>

                        <!-- Campos alineados a la derecha -->
                        <div class="col-md-6">
                            @include('components.text_input', [
                                'name' => 'distrito',
                                'label' => 'Distrito',
                            ])
                            @include('components.text_input', [
                                'name' => 'estado_civil',
                                'label' => 'Estado Civil',
                            ])
                            @include('components.text_input', [
                                'name' => 'telefono',
                                'label' => 'Teléfono',
                            ])
                            <div class="form-group">
                                <label for="nivel">Nivel</label>
                                <select class="form-control @error('nivel') is-invalid @enderror" id="nivel"
                                    name="nivel">
                                    @error('nivel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <option value="" selected disabled>Seleccione Nivel</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="grado">Grado</label>
                                <select class="form-control @error('grado') is-invalid @enderror" id="grado"
                                    name="grado">
                                    @error('grado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <option value="" selected disabled>Seleccione Grado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="seccion">Sección</label>
                                <select class="form-control @error('seccion') is-invalid @enderror" id="seccion"
                                    name="seccion">
                                    @error('seccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <option value="" selected disabled>Seleccione Sección</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                    Registrar</button>
                                <a href="{{ route('Cancelar') }}" class="btn btn-danger"><i class="fas fa-ban"></i>
                                    Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('nivel').addEventListener('change', function() {
            var nivel = this.value;
            var gradoSelect = document.getElementById('grado');
            gradoSelect.innerHTML = '';

            if (nivel === 'Primaria') {
                var options = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto'];
            } else if (nivel === 'Secundaria') {
                var options = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto'];
            }

            options.forEach(function(option) {
                var opt = document.createElement('option');
                opt.value = option;
                opt.innerHTML = option;
                gradoSelect.appendChild(opt);
            });
        });
    </script>
@endsection
