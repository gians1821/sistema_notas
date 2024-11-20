@extends('layout.plantilla')
@section('BarraNavegacion')
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
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Alumno')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestion Alumnos</span>
        </a>
    </li>
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
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{URL::to('/Capacidad')}}">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Gestión Capacidades</span>
        </a>
    </li>
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
<h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> capacidades</h1>
<br>
<nav class="navbar navbar-light">
    @role('Admin')
    <a class="btn btn-primary " href="{{route('Capacidad.create')}}">
        <i class="fas fa-plus"></i> Nuevo Registro
    </a>
    @endrole
    <form class="form-inline my-lg-0" method="GET">
        <div class="d-flex align-items-center">
            <input name="buscarporNombre" class="form-control mr-sm-2" type="search" placeholder="CAPACIDAD" aria-label="Search" value="{{$buscarporNombre}}">
            <select class="form-control w-auto mr-4" id="nivel" name="buscarporNivel">
                <option value="Nivel" selected disabled>SELECCIONE NIVEL</option>
                <option value="PRIMARIA">PRIMARIA</option>
                <option value="SECUNDARIA">SECUNDARIA</option>
            </select>
            <select class="form-control w-auto mr-4" id="grado" disabled name="buscarporGrado">
                <option value="Grado" selected disabled>SELECCIONE GRADO</option>
            </select>
            <select class="form-control w-auto mr-4" id="curso" disabled name="buscarporCurso">
                <option value="Curso" selected disabled>SELECCIONE CURSO</option>
            </select>
            <button class="btn btn-success" type="submit">BUSCAR</button>
        </div>
    </form>
</nav>



<div id="mensaje">
    @if (session('datos'))
    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        {{ session('datos') }}
        <button type="button" class="close" data-dismiss="alert" arialabel="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
</div>
<br>
<table class="table  text-center ">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="w-25">CAPACIDAD_ID</th>
            <th scope="col">NIVEL</th>
            <th scope="col">GRADO</th>
            <th scope="col">CURSO</th>
            <th scope="col">COMPETENCIA</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @if (count($capacidad)<=0) <tr>
            <td colspan="6">No hay registros</td>
            </tr>
            @else
            @foreach($capacidad as $itemcapacidad)
            <tr>
                <td>{{$itemcapacidad->id_competencia}}</td>
                <td>{{ $itemcapacidad->curso && $itemcapacidad->curso->grado && $itemcapacidad->curso->grado->nivel ? $itemcapacidad->curso->grado->nivel->nombre_nivel : 'No asignado' }}</td> <!-- Asegúrate de ajustar 'nombre_nivel' según el nombre real del campo en tu modelo Nivel -->
                <td>{{ $itemcapacidad->curso && $itemcapacidad->curso->grado  ? $itemcapacidad->curso->grado->nombre_grado : 'No asignado' }}</td>
                <td>{{ $itemcapacidad->curso ? mb_strtoupper($itemcapacidad->curso->nombre_curso) : 'No asignado' }}</td>
                <td>{{mb_strtoupper($itemcapacidad->nombre_competencia)}}</td>
                <td>
                    @role('Admin')
                    <a href="{{ route('Capacidad.edit',$itemcapacidad->id_competencia)}}" class="btn btn-info">
                        <img src="{{ asset('plantilla\src\img\logo\editar_blanco.png')}}" alt="Editar" style="width: 30px; height: 30px;">
                    </a>
                    <a href="{{ route('Capacidad.confirmar',$itemcapacidad->id_competencia)}}" class="btn btn-danger btnsm ms-2">
                        <img src="{{ asset('plantilla\src\img\logo\eliminar.png')}}" alt="Eliminar" style="width: 30px; height: 30px;">
                    </a>
                    @endrole
                </td>
            </tr>
            @endforeach
            @endif
    </tbody>
</table>
{{ $capacidad->appends(['buscarporNombre' => $buscarporNombre, 'buscarporGrado' => $buscarporGrado,'buscarporNivel' => $buscarporNivel,'buscarporCurso' => $buscarporCurso])->links() }}
@endsection('Contenido')
@section('script')
<script>
    setTimeout(function() {
        document.querySelector('#mensaje').remove();
    }, 3000);
</script>
<script>
    document.getElementById('nivel').addEventListener('change', function() {
        var nivel = this.value;
        var gradoSelect = document.getElementById('grado');
        var cursoSelect = document.getElementById('curso');
        gradoSelect.innerHTML = '<option value="Grado" selected disabled>SELECCIONE GRADO</option>'; // Agrega la opción por defecto
        cursoSelect.innerHTML = '<option value="Curso" selected disabled>SELECCIONE CURSO</option>'; // Agrega la opción por defecto
        gradoSelect.disabled = false;

        if (nivel === 'Nivel') {
            var options = ['Grado'];
            var cursoOp = ['Curso'];
        }
        if (nivel === 'PRIMARIA') {
            var options = ['PRIMERO', 'SEGUNDO', 'TERCERO', 'CUARTO', 'QUINTO', 'SEXTO'];
            var cursoOp = ['CIENCIA Y AMBIENTE', 'ED. FíSICA', 'ED. RELIGIOSA', 'PERSONAL SOCIAL', 'INGLÉS', 'COMPORTAMIENTO', 'ARTE', 'MATEMÁTICA', 'COMUNICACIÓN', 'COMPUTACIÓN/LABORES', 'TOTAL DE DEMÉRITOS'];
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
    document.getElementById('grado').addEventListener('change', function() {
        var cursoSelect = document.getElementById('curso');
        cursoSelect.disabled = false;
    });
</script>
@endsection