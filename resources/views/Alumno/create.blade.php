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
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos text-center"><strong>Registrar </strong> Nueva Matrícula</h1>
    <br>
    <form method="POST" action="{{ route('Alumno.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <div class="row">
                    @include('components.select_input', [
                        'name' => 'periodo',
                        'label' => 'Periodo',
                        'options' => $periodos,
                        'selected' => 'default'
                    ])
                    <div style="font-size: 1.5em; text-align: center;">
                        <label class="form-label mb-3"><strong>Datos del Apoderado</strong></label>
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                        
                        <label for="profile_photo" class="form-label"><strong>Foto de Perfil</strong></label>
                            <div 
                                class="img-fluid rounded-circle mb-3 d-flex justify-content-center align-items-center"
                                style="width: 200px; height: 200px; background-color: #9e9fa0; overflow: hidden;">
                                <img id="imagePreviewApoderado" src="{{ asset('images/default-user.png') }}" 
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <input type="file" name="profile_photo_Apoderado" id="profile_photo_Apoderado" 
                                class="form-control @error('profile_photo') is-invalid @enderror" accept="image/*"
                                onchange="previewImage(event, 'apoderado')">
                                @error('profile_photo')
                                    <div class="invalid-feedback"><strong> {{ $message }} </strong></div>
                                @enderror
                    </div>
                    <div class="col-md-6">
                        @include('components.text_input', [
                            'name' => 'dni_apoderado',
                            'label' => 'DNI',
                        ])
                        @include('components.text_input', [
                            'name' => 'nombre_apoderado',
                            'label' => 'Nombre',
                        ])
                        @include('components.text_input', [
                            'name' => 'apellido_apoderado',
                            'label' => 'Apellido',
                        ])
                        @include('components.text_input', [
                            'name' => 'email_apoderado',
                            'label' => 'Email',
                        ])

                    </div>
                    <div class="col-md-6">
                        @include('components.password_input', [
                            'name' => 'password',
                            'label' => 'Contraseña',
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.password_input', [
                            'name' => 'confirmar_password',
                            'label' => 'Confirmar Contraseña',
                        ])
                    </div>
                </div>

                <!-- Columna para los campos del formulario -->
                <div style="font-size: 1.5em; text-align: center;">
                    <label class="form-label mt-3 mb-3"><strong>Datos del Alumno</strong></label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center"> 
                        <label for="profile_photo" class="form-label"><strong>Foto de Perfil</strong></label>
                            <div 
                                class="img-fluid rounded-circle mb-3 d-flex justify-content-center align-items-center"
                                style="width: 200px; height: 200px; background-color: #9e9fa0; overflow: hidden;">
                                <img id="imagePreviewAlumno" src="{{ asset('images/default-user.png') }}" 
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <input type="file" name="profile_photo_alumno" id="profile_photo_alumno" 
                                class="form-control @error('profile_photo') is-invalid @enderror" accept="image/*"
                                onchange="previewImage(event, 'alumno')"">
                                @error('profile_photo')
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
                        ])
                        @include('components.date_input', [
                            'name' => 'fecha_nacimiento',
                            'label' => 'Fecha de Nacimiento',
                        ])
                        @include('components.text_input', [
                            'name' => 'pais',
                            'label' => 'País',
                        ])
                        @include('components.text_input', [
                            'name' => 'ciudad',
                            'label' => 'Ciudad',
                        ])
                        <div class="form-group">
                            <label class="form-label" for="seccion"><strong>Sección</strong></label>
                            <select class="form-control @error('seccion') is-invalid @enderror" id="seccion" name="seccion">
                            <option value="" selected disabled>Seleccione una Sección</option>
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
                            ])
                            @include('components.text_input', [
                                'name' => 'estado_civil',
                                'label' => 'Estado Civil',
                            ])
                            @include('components.text_input', [
                                'name' => 'region',
                                'label' => 'Región',
                            ])
                            <div class="form-group">
                                <label class="form-label" for="nivel"><strong>Nivel</strong></label>
                                <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel" onchange="fetchGrados(this.value)">
                                    <option value="" selected disabled>Seleccione un Nivel</option>
                                    @foreach ($nivel as $itemniveles)
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
                            ])
                            @include('components.text_input', [
                                'name' => 'telefono',
                                'label' => 'Teléfono',
                            ])
                            @include('components.text_input', [
                                'name' => 'distrito',
                                'label' => 'Distrito',
                            ])
                            <div class="form-group">
                                <label class="form-label" for="grado"><strong>Grado</strong></label>
                                <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado" onchange="fetchSecciones(this.value)">
                                    <option value="" selected disabled>Seleccione un Grado</option>    
                                </select>
                                @error('grado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4 mb-3">
                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-save"></i>Registrar</button>
                    <a href="{{ route('Cancelar') }}" class="btn btn-danger mx-2"><i class="fas fa-ban"></i>Cancelar</a>
                </div>
            </div>
        </form>
@endsection

@section('script')
    <script>
        function fetchGrados(nivelId) {
            if (nivelId) {
                fetch(`/grados/${nivelId}`) 
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
                fetch(`/secciones/${gradoId}`) 
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
    <script>
        function previewImage(event, type) {
            const reader = new FileReader();
            let imagePreview;

            // Determina qué elemento de imagen actualizar según el tipo
            if (type === 'apoderado') {
                imagePreview = document.getElementById('imagePreviewApoderado');
            } else if (type === 'alumno') {
                imagePreview = document.getElementById('imagePreviewAlumno');
            }

            reader.onload = function () {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block'; // Muestra la imagen
            };

            // Lee el archivo seleccionado
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>

@endsection