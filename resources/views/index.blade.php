@extends('layout.plantilla')
@section('BarraNavegacion')
<!-- LISTA DE CONTENIDOS -->
<ul class="sidebar-nav">
    <!-- TITULO 1 -->
    <li class="sidebar-header">
        PRINCIPAL
    </li>
    <!-- DASHBOARD -->
    <li class="sidebar-item active">
        <a class="sidebar-link" href="{{route('Home.index')}}">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Inicio</span>
        </a>
    </li>

    <!-- PROFILE -->
    @role('Admin')
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('admin.usuarios.index') }}">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Usuarios</span>
        </a>
    </li>
    @endrole

    <!-- SIGN IN -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('User.Login')}}">
            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
        </a>
    </li>
    <!-- TITULO 2 -->
    <li class="sidebar-header">
        MANTENEDORES
    </li>
    <!-- AQUI ES DONDE TRABAJAREMOS -->
    <!-- GESTION DE ALUMNOS -->
    @role('Admin')
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Alumno')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestion Alumnos</span>
        </a>
    </li>
    @endrole
    @role('Docente')
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Alumno')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestion Alumnos</span>
        </a>
    </li>
    @endrole
    <!-- GESTION DE GRADOS -->
    @role('Admin')
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Seccion')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Grados</span>
        </a>
    </li>
    <!-- GESTION DE CURSOS -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Curso')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Cursos</span>
        </a>
    </li>
    <!-- GESTION DE CURSOS POR GRADOS -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/CursoPorGrado')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Cursos por Grados</span>
        </a>
    </li>
    @endrole
    <!-- GESTION DE CAPACIDADES -->
    @role('Docente')
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Capacidad')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Capacidades</span>
        </a>
    </li>
    @endrole
    @role('Admin')
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Capacidad')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Capacidades</span>
        </a>
    </li>
    @endrole
    <!-- GESTION DE PERSONAL -->
    @role('Admin')
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('Personal.index')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión de Personal</span>
        </a>
    </li>
    @endrole
    <!-- GESTION DE CATEDRAS -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('Catedra.index')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Notas</span>
        </a>
    </li>
</ul>
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
                <img src="{{ asset('images/prueba.png') }}" alt="Foto de Perfil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
                <h2>{{auth()->user()->name}}</h2>
                <p>{{auth()->user()->email}}</p>
            </div>
            <div class="col-md-8">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Nivel de acceso</label>
                        <input type="text" class="form-control" id="telefono" value="{{ auth()->user()->getRoleNames()->implode(', ') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="direccion" value="Usted puede ver las notas de sus hijos" readonly>
                    </div>
                </form>
            </div>
        </div>

        <h3 class="mt-5">Información de sus Hijo(s)</h3>
        <div class="row">
            <div class="col-md-4 mb-3 text-center">
                <img src="{{ asset('images/pruebita.jpg') }}" alt="Hijo 1" class="img-fluid rounded" style="height: 200px;">
                <h4>Fatima</h4>
                <a href="" class="btn btn-primary mt-2">Ver Detalles</a>
            </div>
        </div>
    </div>
</div>
@endsection('Contenido')