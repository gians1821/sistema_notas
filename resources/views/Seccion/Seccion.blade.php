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
        <a class="sidebar-link" href="{{route('admin.usuarios.index')}}">
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
    <li class="sidebar-item active">
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
@endsection('BarraNavegacion')
@section('Contenido')
<!-- CONTENIDO DE LA PAGINA -->
<h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> grados y secciones</h1>
<br>
<nav class="navbar navbar-light ">
    <a class="btn btn-primary " href="{{route('Seccion.create')}}">
        <i class="fas fa-plus"></i> Nuevo Registro
    </a>
    <form class="form-inline my-lg-0 m-2" method="GET">
        <div class="input-group ">
            <select class="form-control ml-2 " id="nivel" name="buscarporNivel">
                <option value="Nivel" selected>Nivel</option>
                <option value="Primaria">PRIMARIA</option>
                <option value="Secundaria">SECUNDARIA</option>
            </select>
            <select class="form-control ml-2 " id="grado" name="buscarporGrado">
                <option value="" selected>Grado</option>
                <option value="PRIMERO">PRIMERO</option>
                <option value="SEGUNDO">SEGUNDO</option>
                <option value="TERCERO">TERCERO</option>
                <option value="CUARTO">CUARTO</option>
                <option value="QUINTO">QUINTO</option>
                <option value="SEXTO">SEXTO</option>
            </select>
            <select class="form-control ml-2 " id="seccion" name="buscarporSeccion">
                <option value="" selected>Seccion</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
            <div class="input-group-append ml-2">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
            </div>
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
            <th scope="col" class="w-25">SECCION_ID</th>
            <th scope="col">NIVEL</th>
            <th scope="col">GRADO</th>
            <th scope="col">SECCION</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @if (count($seccion)<=0) <tr>
            <td colspan="5">No hay registros</td>
            </tr>
            @else
            @foreach($seccion as $itemseccion)
            <tr>
                <td>{{$itemseccion->id_seccion}}</td>
                <td>{{ $itemseccion->grado && $itemseccion->grado->nivel ? $itemseccion->grado->nivel->nombre_nivel : 'No asignado' }}</td> <!-- Asegúrate de ajustar 'nombre_nivel' según el nombre real del campo en tu modelo Nivel -->
                <td>{{ $itemseccion->grado ? $itemseccion->grado->nombre_grado : 'No asignado' }}</td>
                <td>{{$itemseccion->nombre_seccion}}</td>
                <td>
                    <a href="{{ route('Seccion.confirmar',$itemseccion->id_seccion)}}" class="btn btn-danger btnsm ms-2">
                        <img src="{{ asset('plantilla\src\img\logo\eliminar.png')}}" alt="Eliminar" style="width: 30px; height: 30px;">
                    </a>
                </td>
            </tr>
            @endforeach
            @endif
    </tbody>
</table>
{{$seccion->appends(['buscarporSeccion' => $buscarporSeccion,'buscarporGrado' => $buscarporGrado,'buscarporNivel' => $buscarporNivel])->links() }};
@endsection('Contenido')
@section('script')
<script>
    setTimeout(function() {
        document.querySelector('#mensaje').remove();
    }, 3000);
</script>
@endsection('script')