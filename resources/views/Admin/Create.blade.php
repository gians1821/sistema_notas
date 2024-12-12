@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
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
    <h1 class="h3 mb-3 titulos text-center"><strong>Crear un</strong> Usuario</h1>
    <br>
    <form method="POST" action="{{ route('admin.usuarios.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <div class="row">
                    <!-- Columna para la imagen y el input -->
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <label for="profile_photo" class="form-label"><strong>Foto de Perfil</strong></label>
                        <div 
                            class="img-fluid rounded-circle mb-3 d-flex justify-content-center align-items-center"
                            style="width: 200px; height: 200px; background-color: #9e9fa0; overflow: hidden;">
                            <img id="imagePreview" src="{{ asset('images/default-user.png') }}" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <input type="file" name="profile_photo" id="profile_photo" 
                            class="form-control @error('profile_photo') is-invalid @enderror" accept="image/*"
                            onchange="previewImage(event)">
                            @error('profile_photo')
                                <div class="invalid-feedback"><strong> {{ $message }} </strong></div>
                            @enderror
                    </div>
                    
                    <!-- Columna para los campos del formulario -->
                    <div class="col-md-6">
                        @include('components.text_input', [
                            'label' => 'Nombre Completo',
                            'name' => 'name',
                        ])

                        @include('components.text_input', [
                            'label' => 'Email',
                            'name' => 'email',
                        ])

                        @include('components.password_input', [
                            'label' => 'Contraseña',
                            'name' => 'password',
                        ])

                        @include('components.password_input', [
                            'label' => 'Confirmar Contraseña',
                            'name' => 'password_confirmation',
                        ])

                        @include('components.select_input', [
                            'label' => 'Listado de roles',
                            'name' => 'rol',
                            'options' => $roles,
                            'selected' => 0,
                        ])
                    </div>
                </div>

                <!-- Botones centrados -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Registrar</button>
                    <a href="{{ route('CancelarUsuario') }}" class="btn btn-danger mx-2"><i class="fas fa-ban"></i> Cancelar</a>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreview');
            reader.onload = function () {
                imagePreview.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection('script')