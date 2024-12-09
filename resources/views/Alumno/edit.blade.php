@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')

    <style>
        .error-message {
            color: darkred; 
            font-size: 0.8em; 
            margin-top: 15px; 
        }
        .alert-success {
            color: green;
            font-size: 1.0em;
            margin-top: 15px;
            align-items: center;
            justify-content: center;
        }
    </style>

    <h1 class="h3 mb-3 titulos text-center"><strong>Editar </strong> Alumno</h1>
    <br>
    <form method="POST" action="{{ route('Alumno.update', $alumnos->id_alumno) }}" enctype="multipart/form-data">
    @method('put')
    @csrf
        <div class="card mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <div class="row">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center"> 
                            <label for="profile_photo_alumno" class="form-label"><strong>Foto de Perfil</strong></label>
                                <div 
                                    class="img-fluid rounded-circle mb-3 d-flex justify-content-center align-items-center"
                                    style="width: 200px; height: 200px; background-color: #9e9fa0; overflow: hidden;">
                                    <img id="imagePreviewAlumno" src="{{ $alumnos->profile_photo ? asset('storage/' . $alumnos->profile_photo) : asset('images/default-user.png') }}" 
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>

                                <input type="file" name="profile_photo_alumno" id="profile_photo_alumno" 
                                    class="form-control @error('profile_photo_alumno') is-invalid @enderror" accept="image/*"
                                    onchange="previewImage(event, 'alumno')">
                                    @error('profile_photo_alumno')
                                        <div class="invalid-feedback"><strong> {{ $message }} </strong></div>
                                    @enderror
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>
                        

                    <div class="row">
                        <!-- Campos alineados a la izquierda -->
                        <div class="col-md-4">
                            @include('components.text_input', [
                                'name' => 'dni',
                                'label' => 'DNI',
                                'value' => $alumnos->dni,
                            ])
                            @include('components.text_input', [
                                'name' => 'fecha_nacimiento',
                                'label' => 'Fecha de Nacimiento',
                                'value' => $alumnos->fecha_nacimiento,
                            ])
                            @include('components.text_input', [
                                'name' => 'pais',
                                'label' => 'País',
                                'value' => $alumnos->pais,
                            ])
                            @include('components.text_input', [
                                'name' => 'ciudad',
                                'label' => 'Ciudad',
                                'value' => $alumnos->ciudad,
                            ])
                            <div class="form-group">
                                <label class="form-label" for="seccion"><strong>Sección</strong></label>
                                <select class="form-control @error('seccion') is-invalid @enderror" id="seccion" name="seccion">
                                <option value="{{ $seccion->id_seccion }}" selected >{{ $seccion->nombre_seccion }}</option>
                                </select>
                                @error('seccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                            <!-- Campos alineados en el centro -->
                            <div class="col-md-4">
                                @include('components.text_input', [
                                    'name' => 'nombre_alumno',
                                    'label' => 'Nombre',
                                    'value' => $alumnos->nombre_alumno,
                                ])
                                @include('components.text_input', [
                                    'name' => 'estado_civil',
                                    'label' => 'Estado Civil',
                                    'value' => $alumnos->estado_civil,
                                ])
                                @include('components.text_input', [
                                    'name' => 'region',
                                    'label' => 'Región',
                                    'value' => $alumnos->region,
                                ])
                                <div class="form-group">
                                    <label class="form-label" for="nivel"><strong>Nivel</strong></label>
                                    <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel" onchange="fetchGrados(this.value)">
                                        <option value="{{ $nivel->id_nivel }}" selected>{{ $nivel->nombre_nivel }}</option>
                                        @foreach ($nivels as $itemniveles)
                                            <option value="{{ $itemniveles->id_nivel }}"
                                                {{ request('nivel') == $itemniveles->id_nivel ? 'selected' : '' }}>
                                                {{ $itemniveles->nombre_nivel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nivel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- Campos alineados a la derecha -->
                            <div class="col-md-4">
                                @include('components.text_input', [
                                    'name' => 'apellido_alumno',
                                    'label' => 'Apellido',
                                    'value' => $alumnos->apellido_alumno,
                                ])
                                @include('components.text_input', [
                                    'name' => 'telefono',
                                    'label' => 'Teléfono',
                                    'value' => $alumnos->telefono,
                                ])
                                @include('components.text_input', [
                                    'name' => 'distrito',
                                    'label' => 'Distrito',
                                    'value' => $alumnos->distrito,
                                ])
                                <div class="form-group">
                                    <label class="form-label" for="grado"><strong>Grado</strong></label>
                                    <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado" onchange="fetchSecciones(this.value)">
                                        <option value="{{ $grado->id_grado }}" selected >{{ $grado->nombre_grado }}</option>    
                                    </select>
                                    @error('grado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4 mb-3">
                        <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Actualizar </button>
                        <a href="{{ route('Cancelar') }}" class="btn btn-danger mx-2"><i class="fas fa-ban"></i>Cancelar</a>
                    </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        function fetchGrados(nivelId) {
            if (nivelId) {
                fetch(`/api/grados/${nivelId}`) 
                    .then(response => response.json())
                    .then(data => {
                        let gradoSelect = document.getElementById('grado');
                        gradoSelect.innerHTML = '<option value="" selected disabled>Seleccione un Grado</option>';
                        
                        data.forEach(grado => {
                            let option = document.createElement('option');
                            option.value = grado.id_grado; 
                            option.textContent = grado.nombre_grado; 
                            gradoSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('grado').innerHTML = '<option value="" selected disabled>Seleccione un Grado</option>'; 
            }
        }

        function fetchSecciones(gradoId) {
            if (gradoId) {
                fetch(`/api/secciones/${gradoId}`) 
                    .then(response => response.json())
                    .then(data => {
                        let seccionSelect = document.getElementById('seccion');
                        seccionSelect.innerHTML = '<option value="" selected disabled>Seleccione una Sección</option>';
                        
                        data.forEach(seccion => {
                            let option = document.createElement('option');
                            option.value = seccion.id_seccion; 
                            option.textContent = seccion.nombre_seccion; 
                            seccionSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('seccion').innerHTML = '<option value="" selected disabled>Seleccione una Sección</option>'; 
            }
        }
    </script>
@endsection
