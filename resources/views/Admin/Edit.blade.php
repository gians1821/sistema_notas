@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos text-center"><strong>Editar</strong> Usuario</h1>
    <br>
    <form method="POST" action="{{ route('admin.usuarios.update', $users->id) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <div class="row">
                    <!-- Columna para la imagen y el input -->
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center mt-2">
                        <label for="profile_photo" class="form-label"><strong>Foto de Perfil</strong></label>
                        <div 
                            class="img-fluid rounded-circle mb-5 d-flex justify-content-center align-items-center"
                            style="width: 200px; height: 200px; background-color: #9e9fa0; overflow: hidden;">
                            <img id="imagePreview" src="{{ $users->profile_photo ? asset('storage/' . $users->profile_photo) : asset('images/default-user.png') }}" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <input type="file" name="profile_photo" id="profile_photo" 
                            class="form-control @error('profile_photo') is-invalid @enderror" accept="image/*"
                            onchange="previewImage(event)">
                        @error('profile_photo')
                            <div class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </div>
                        @enderror
                    </div>
                    
                    <!-- Columna para los campos del formulario -->
                    <div class="col-md-6">
                        @include('components.text_input', [
                            'label' => 'Nombre Completo',
                            'name' => 'name',
                            'value' => $users->name,
                        ])

                        <div class="form-group">
                            <label class="form-label"><strong>Email</strong></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email_user" name="email" value="{{ $users->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><strong>Contraseña</strong></label>
                            <input type="password" class="form-control" id="password_user" name="password" placeholder="Dejar en blanco para no cambiar">
                        </div>

                        <label class="form-label"><strong>Listado de Roles</strong></label>
                        <select class="form-control w-100 mr-4 @error('rol') is-invalid @enderror" id="rol" name="rol">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->name === $rolecito ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                            @error('rol')
                                <div class="invalid-feedback">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </div>
                            @enderror
                        </select>
                    </div>
                </div>

                <!-- Botones centrados -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Actualizar</button>
                    <a href="{{ route('CancelarUsuario') }}" class="btn btn-danger mx-2"><i class="fas fa-ban"></i> Cancelar</a>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Vista previa de la imagen seleccionada
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreview');
            reader.onload = function () {
                imagePreview.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
