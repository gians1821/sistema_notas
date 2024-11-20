@extends('layout.plantilla')
@section('BarraNavegacion')
<ul class="sidebar-nav">
    <!-- TITULO 1 -->
    <li class="sidebar-header">
        PRINCIPAL
    </li>
    <!-- DASHBOARD -->
    <li class="sidebar-item">
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
    <li class="sidebar-item active">
        <a class="sidebar-link" href="{{route('Catedra.index')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Notas</span>
        </a>
    </li>
</ul>
@endsection
@section('Contenido')
<!-- Registro de Alumnos -->
<h1 class="h3 mb-3"><strong>Registro</strong> Nota</h1>
<form method="POST" action="{{ route('Nota.update', ['id_alumno' => $nota->alumno->id_alumno,'id_curso' => $nota->curso->id_curso])}}">
    @method('put')
    @csrf
    <div class="form-group">
        <div class="form-group">
            <label for="">Alumno(a)</label>
            <input type="text" class="form-control" id="alumno_id_alumno" name="alumno_id_alumno" value="{{$nota->alumno->nombre_alumno.' '.$nota->alumno->apellido_alumno}}" disabled>
        </div>
        <div class="form-group">
            <label for="">Curso</label>
            <input type="text" class="form-control" id="curso_id_curso" name="curso_id_curso" value="{{$nota->curso->nombre_curso}}" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="nota1">Nota 1</label>
        <input type="text" class="form-control @error('nota1') is-invalid @enderror " id="nota1" name="nota1" value="{{$nota->nota1}}">
        @error('nota1')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nota2">Nota 2</label>
        <input type="text" class="form-control @error('nota2') is-invalid @enderror " id="nota2" name="nota2" value="{{$nota->nota2}}">
        @error('nota2')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nota3">Nota 3</label>
        <input type="text" class="form-control @error('nota3') is-invalid @enderror " id="nota3" name="nota3" value="{{$nota->nota3}}">
        @error('nota3')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
    <a href="{{ route('Catedra.index')}}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
</form>
@endsection