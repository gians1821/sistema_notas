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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="h3 mb-3 text-left"><strong>Registro</strong> Nuevo</h1>
            <form method="POST" action="{{ route('Alumno.store') }}">
                @csrf
                <div class="row">
                    <!-- Campos alineados a la izquierda -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre_alumno">Nombre</label>
                            <input type="text" class="form-control @error('nombre_alumno') is-invalid @enderror" id="nombre_alumno" name="nombre_alumno">
                            @error('nombre_alumno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="apellido_alumno">Apellido</label>
                            <input type="text" class="form-control @error('apellido_alumno') is-invalid @enderror" id="apellido_alumno" name="apellido_alumno">
                            @error('apellido_alumno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento">
                            @error('fecha_nacimiento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni">
                            @error('dni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pais">País</label>
                            <input type="text" class="form-control @error('pais') is-invalid @enderror" id="pais" name="pais">
                            @error('pais')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="region">Región</label>
                            <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region">
                            @error('region')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control @error('ciudad') is-invalid @enderror" id="ciudad" name="ciudad">
                            @error('ciudad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Campos alineados a la derecha -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="distrito">Distrito</label>
                            <input type="text" class="form-control @error('distrito') is-invalid @enderror" id="distrito" name="distrito">
                            @error('distrito')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estado_civil">Estado Civil</label>
                            <input type="text" class="form-control @error('estado_civil') is-invalid @enderror" id="estado_civil" name="estado_civil">
                            @error('estado_civil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono">
                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nivel">Nivel</label>
                            <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel">
                                @error('nivel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <option value="" selected disabled>Seleccione Grado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="seccion">Sección</label>
                            <select class="form-control @error('seccion') is-invalid @enderror" id="seccion" name="seccion">
                                @error('seccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <option value="" selected disabled>Seleccione Sección</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div class="form-group text-right mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
                            <a href="{{ route('Cancelar') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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