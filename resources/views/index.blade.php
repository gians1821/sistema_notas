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
            <div class="col-md-4 text-center">
                <img src="{{ asset('images/prueba.png') }}" alt="Foto de Perfil" class="img-fluid rounded-circle mb-3"
                    style="width: 150px; height: 150px;">
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
                    @role('Docente')
                    <div class="mb-3">
                        <label for="direccion" class="form-label"><strong> Descripción </strong></label>
                        <input type="text" class="form-control" id="direccion"
                            value="Puede visualizar y registrar las notas del estudiante" readonly>
                    </div>
                    @endrole
                    @role('Admin')
                    <div class="mb-3">
                        <label for="direccion" class="form-label"><strong> Descripción </strong></label>
                        <input type="text" class="form-control" id="direccion"
                            value="Tienes control total del sistema" readonly>
                    </div>
                    @endrole
                    @role('Padre')
                    <div class="mb-3">
                        <label for="direccion" class="form-label"><strong> Descripción </strong></label>
                        <input type="text" class="form-control" id="direccion"
                            value="Usted puede ver las notas de sus hijos" readonly>
                    </div>
                    @endrole
                </form>
            </div>
        </div>
        @role('Padre')
        <h3 class="mt-5">Información de sus Hijo(s)</h3>
        <div class="row">
            <div class="col-md-4 mb-3 text-center">
                <img src="{{ asset('images/pruebita.jpg') }}" alt="Hijo 1" class="img-fluid rounded"
                    style="height: 200px;">
                <h4>Jose luis</h4>
                <a href="" class="btn btn-primary mt-2">Ver Detalles</a>
            </div>
        </div>
        @endrole
    </div>
    </div>
@endsection('Contenido')
