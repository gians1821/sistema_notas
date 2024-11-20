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
    <li class="sidebar-item">
        <a class="sidebar-link" href="#">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
        </a>
    </li>
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
    <li class="sidebar-item active">
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
<!-- Registro de Personal -->
<h1 class="h3 mb-3"><strong>Registro</strong> Personal</h1>
<form method="POST" action="{{ route('Personal.store')}}">
    @csrf
    <!--DNI-->
    <div class="form-group">
        <label for="dNI">DNI</label>
        <input type="text" class="form-control @error('dNI') is-invalid @enderror " id="dNI" name="dNI" value="{{ old('dNI')}}">
        @error('dNI')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <!--NOMBRE-->
    <div class="form-group">
        <label for="nombre">NOMBRE</label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre')}}">
        @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>

    <!--APELLIDO-->
    <div class="form-group">
        <label for="apellido">APELLIDO</label>
        <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido')}}">
        @error('apellido')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>

    <!--DIRECCION-->
    <div class="form-group">
        <label for="direccion">DIRECCION</label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion')}}">
        @error('direccion')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <!--FECHA DE NACIMIENTO-->
    <div class="form-group">
        <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
        <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento')}}">
        @error('fecha_nacimiento')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <!--TELEFONO-->
    <div class="form-group">
        <label for="telefono">TELÉFONO</label>
        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono')}}">
        @error('telefono')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <!--TIPO DE PERSONAL-->
    <div class="form-group">
        <label for="id_tipo_personal">TIPO PERSONAL</label>
        <select class="form-control @error('id_tipo_personal') is-invalid @enderror" id="id_tipo_personal" name="id_tipo_personal">
            @error('id_tipo_personal')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
            <option value="TIPO DE PERSONAL" selected disabled>SELECCIONE</option>
            <option value="DOCENTE">DOCENTE</option>
            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
            <option value="DIRECTOR">DIRECTOR</option>
            <option value="ASISTENTE">ASISTENTE</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nivel">NIVEL</label>
        <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel" disabled>
            @error('nivel')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
            <option value="Nivel" selected disabled>SELECCIONE</option>
            <option value="PRIMARIA">PRIMARIA</option>
            <option value="SECUNDARIA">SECUNDARIA</option>
        </select>
    </div>
    <div class="form-group">
        <label for="grado">GRADO</label>
        <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado" disabled>
            @error('grado')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
            <option value="Grado" selected disabled>SELECCIONE</option>

        </select>
    </div>
    <div class="form-group">
        <label for="curso">CURSO</label>
        <select class="form-control @error('curso') is-invalid @enderror" id="curso" name="curso" disabled>
            @error('curso')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
            <option value="Curso" selected disabled>SELECCIONE</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
    <a href="{{ route('CancelarPersonal')}}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
</form>
@endsection
@section('script')
<script>
    document.getElementById('id_tipo_personal').addEventListener('change', function() {
        var tipoPersonal = this.value;
        var nivelSelect = document.getElementById('nivel');
        var gradoSelect = document.getElementById('grado');
        var cursoSelect = document.getElementById('curso');

        if (tipoPersonal === 'DOCENTE') {
            nivelSelect.disabled = false;
            gradoSelect.disabled = false;
            cursoSelect.disabled = false;
        } else {
            nivelSelect.disabled = true;
            gradoSelect.disabled = true;
            cursoSelect.disabled = true;
        }
    });
    document.getElementById('nivel').addEventListener('change', function() {
        var nivel = this.value;
        var gradoSelect = document.getElementById('grado');
        var cursoSelect = document.getElementById('curso');
        gradoSelect.innerHTML = '<option value="Grado" selected disabled>SELECCIONE</option>'; // Agrega la opción por defecto
        cursoSelect.innerHTML = '<option value="Curso" selected disabled>SELECCIONE</option>'; // Agrega la opción por defecto

        if (nivel === 'Nivel') {
            var options = ['Grado'];
            var cursoOp = ['Curso'];
        }
        if (nivel === 'PRIMARIA') {
            var options = ['PRIMERO', 'SEGUNDO', 'TERCERO', 'CUARTO', 'QUINTO', 'SEXTO'];
            var cursoOp = ['CIENCIA Y AMBIENTE', 'ED. FÍSICA', 'ED. RELIGIOSA', 'PERSONAL SOCIAL', 'INGLÉS', 'COMPORTAMIENTO', 'ARTE', 'MATEMÁTICA', 'COMUNICACIÓN', 'COMPUTACIÓN/LABORES', 'TOTAL DE DEMÉRITOS'];
        } else if (nivel === 'SECUNDARIA') {
            var options = ['PRIMERO', 'SEGUNDO', 'TERCERO', 'CUARTO', 'QUINTO'];
            var cursoOp = ['CIUDADANÍA Y CÍVICA', 'CIENCIAS SOCIALES', 'ED. PARA EL TRABAJO.', 'ED. FÍSICA', 'COMUNICACIÓN', 'ARTE Y CULTURA', 'INGLÉS', 'MATEMÁTICA', 'CIENCIA Y TECNOLOGÍA', 'ED. RELIGIOSA', 'COMPORTAMIENTO', 'TOTAL DE DEMÉRITOS'];
        }

        options.forEach(function(option) {
            var opt = document.createElement('option');
            opt.value = option;
            opt.innerHTML = option;
            gradoSelect.appendChild(opt);
        });

        cursoOp.forEach(function(option) {
            var opt = document.createElement('option');
            opt.value = option;
            opt.innerHTML = option;
            cursoSelect.appendChild(opt);
        });
    });
</script>
@endsection