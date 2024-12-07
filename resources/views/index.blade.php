@extends('layout.plantilla')
@section('BarraNavegacion')
    <!-- LISTA DE CONTENIDOS -->
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h2 mb-5">
        <span style="color: #FFD700;"><Strong>Bienvenido a la</Strong></span>
        <span style="color: #003366;"><Strong>Institución Educativa Brüning</Strong></span>
    </h1>


    <div class="container mt-5">
        <h1 class="text-center mb-4 mr-5">Perfil de Usuario</h1>
        <div class="row">
            <div class="col-md-4 text-center" style="transform: translateY(-40px);">
                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/default-user.png') }}" 
                    alt="Foto de Perfil" 
                    class="img-fluid rounded-circle mb-3" 
                    style="width: 200px; height: 200px; object-fit: cover;">
                <h2>{{ auth()->user()->name }}</h2>
                <p>{{ auth()->user()->email }}</p>
            </div>
            <div class="col-md-8">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label"> <strong> Nombre Completo </strong></label>
                        <input type="text" class="form-control" id="nombre" value="{{ auth()->user()->name }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label"><strong> Nivel de acceso </strong></label>
                        <input type="text" class="form-control" id="telefono"
                            value="{{ auth()->user()->getRoleNames()->implode(', ') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label"><strong> Descripción </strong></label>
                        <input type="text" class="form-control" id="direccion"
                            value="{{ $roleDescription }}" readonly>
                    </div>
                    
                </form>
            </div>
        </div>

        @if($alumnos->isNotEmpty())
            <hr style="border: 1px solid #0a0a0a; margin: 10px 0;">
            <h3 class="mt-5 mb-4">Información de sus Hijo(s)</h3>
            <div class="row">
                @foreach($alumnos as $alumno)
                    <div class="col-md-4 mb-3 text-center">
                        <div class="card" style="width: 70%;">
                            <img src="{{ asset('images/pruebita.jpg') }}" class="card-img-top img-fluid rounded" 
                                style="width: 150px; height: 150px; margin: auto;">
                            <div class="card-body">
                                <h4 class="card-title">{{ $alumno->nombre_alumno }} {{ $alumno->apellido_alumno }}</h4>
                                <a href="" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection('Contenido')
