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
    <li class="sidebar-item active">
        <a class="sidebar-link" href="{{route('admin.usuarios.index')}}">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Usuarios</span>
        </a>
    </li>
    @endrole
    <!-- SIGN IN -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="#">
            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
        </a>
    </li>
    <!-- TITULO 2 -->
    <li class="sidebar-header">
        MANTENEDORES
    </li>
    <!-- AQUI ES DONDE TRABAJAREMOS -->
    <!-- GESTION DE ALUMNOS -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Alumno')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestion Alumnos</span>
        </a>
    </li>
    <!-- GESTION DE GRADOS -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Seccion')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Grados</span>
        </a>
    </li>
    <!-- GESTION DE CURSOS -->
    <li class="sidebar-item active">
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
    <!-- GESTION DE CAPACIDADES -->
    <li class="sidebar-item ">
        <a class="sidebar-link" href="{{URL::to('/Capacidad')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Capacidades</span>
        </a>
    </li>
    <!-- GESTION DE PERSONAL -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('Personal.index')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión de Personal</span>
        </a>
    </li>
    <!-- GESTION DE CATEDRAS -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('Catedra.index')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Notas</span>
        </a>
    </li>
</ul>
@endsection
@section('Contenido')
<!-- Registro de Alumnos -->
<h1 class="h3 mb-3"><strong>Registro</strong> Nuevo</h1>
<form method="POST" action="{{ route('Curso.store')}}">
    @csrf
    <div class="form-group">
        <label for="nombre_curso">Nombre del Curso</label>
        <input type="text" class="form-control @error('nombre_curso') is-invalid @enderror " id="nombre_curso" name="nombre_curso">
        @error('nombre_curso')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nivel">Nivel</label>
        <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel">
            @error('nivel')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
            <option value="" selected disabled>Seleccione Nivel</option>
            <option value="Primaria">Primaria</option>
            <option value="Secundaria">Secundaria</option>
        </select>
    </div>
    <div class="form-group">
        <label for="grado">Grado</label>
        <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado">
            @error('grado')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
            <option value="" selected disabled>Seleccione Grado</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
    <a href="{{ route('CancelarCurso')}}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
</form>
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