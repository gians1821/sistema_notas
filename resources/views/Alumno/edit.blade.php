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
    <li class="sidebar-item active">
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
    <!-- GESTION DE CAPACIDADES -->
    <li class="sidebar-item">
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
<h1 class="h3 "><strong>Editar</strong> Registro</h1>
<form method="POST" action="{{ route('Alumno.update', $alumnos->id_alumno) }}">
    @method('put')
    @csrf
    <div class="row">
        <!-- Columna izquierda -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre_alumno">Id Alumno</label>
                <input type="text" class="form-control" id="id_alumno" name="id_alumno" value="{{ $alumnos->id_alumno }}" disabled>
            </div>
            <div class="form-group">
                <label for="nombre_alumno">Nombre</label>
                <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" value="{{ $alumnos->nombre_alumno }}">
            </div>
            <div class="form-group">
                <label for="apellido_alumno">Apellido</label>
                <input type="text" class="form-control" id="apellido_alumno" name="apellido_alumno" value="{{ $alumnos->apellido_alumno }}">
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $alumnos->fecha_nacimiento }}">
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="{{ $alumnos->dni }}">
            </div>
            <div class="form-group">
                <label for="pais">País</label>
                <input type="text" class="form-control" id="pais" name="pais" value="{{ $alumnos->pais }}">
            </div>
            <div class="form-group">
                <label for="region">Región</label>
                <input type="text" class="form-control" id="region" name="region" value="{{ $alumnos->region }}">
            </div>
            <div class="form-group text-left">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                <a href="{{ route('Cancelar') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
            </div>
        </div>
        <!-- Columna derecha -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="distrito">Distrito</label>
                <input type="text" class="form-control" id="distrito" name="distrito" value="{{ $alumnos->distrito }}">
            </div>
            <div class="form-group">
                <label for="estado_civil">Estado Civil</label>
                <input type="text" class="form-control" id="estado_civil" name="estado_civil" value="{{ $alumnos->estado_civil }}">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $alumnos->telefono }}">
            </div>
            <div class="form-group">
                <label for="nivel">Nivel</label>
                <select class="form-control" id="nivel" name="nivel">
                    <option value="" selected disabled>Seleccione Nivel</option>
                    <option value="Primaria">Primaria</option>
                    <option value="Secundaria">Secundaria</option>
                </select>
            </div>
            <div class="form-group">
                <label for="grado">Grado</label>
                <select class="form-control" id="grado" name="grado">
                    <option value="" selected disabled>Seleccione Grado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="seccion">Sección</label>
                <select class="form-control" id="seccion" name="seccion">
                    <option value="" selected disabled>Seleccione Sección</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $alumnos->ciudad }}">
            </div>
        </div>
    </div>
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