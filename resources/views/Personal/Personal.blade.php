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
@endsection('BarraNavegacion')
@section('Contenido')
<!-- CONTENIDO DE LA PAGINA -->
<h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> personal</h1>
<br>
<nav class="navbar navbar-light ">
    <a class="btn btn-primary " href="{{route('Personal.create')}}">
        <i class="fas fa-plus"></i> Nuevo Registro
    </a>
    <form class="form-inline my-lg-0 m-2" method="GET">
        <div class="input-group ">
            <select class="form-control w-auto mr-4" id="tipopersonal" name="buscarporTipoPersonal">
                <option value="TipoPersonal" selected disabled>SELECCIONE TIPO DE PERSONAL</option>
                <option value="DOCENTE">DOCENTE</option>
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                <option value="DIRECTOR">DIRECTOR</option>
                <option value="ASISTENTE">ASISTENTE</option>
            </select>
            <input name="buscarporNombre" class="form-control mr-sm-2" type="search" placeholder="NOMBRE" aria-label="Search">
            <input name="buscarporApellido" class="form-control mr-sm-2" type="search" placeholder="APELLIDO" aria-label="Search">
            <div class="input-group-append ml-2">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
            </div>
        </div>
    </form>
</nav>
<br>
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

<table class="table text-center">
    <thead class="thead-dark ">
        <tr>
            <th scope="col" class="w-25">Id Personal</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Tipo de Personal</th>
            {{--
            <th scope="col">Curso</th>
            <th scope="col">Grado</th>
            <th scope="col">Nivel</th>
            --}}
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($personal)<=0) <tr>
            <td colspan="3">No hay registros</td>
            </tr>
            @else
            @foreach($personal as $itempersonal)
            <tr>
                <td>
                    {{$itempersonal->id_personal}}
                </td>
                <td>
                    {{mb_strtoupper($itempersonal->nombre)}}
                </td>
                <td>
                    {{mb_strtoupper($itempersonal->apellido)}}
                </td>
                <td>
                    {{ $itempersonal->tipopersonal->nombre_tipopersonal }}
                </td>
                {{--
                <td>
                    {{$itempersonal->curso ? mb_strtoupper($itempersonal->curso->nombre_curso) : ''}}
                </td>
                <td>
                    {{$itempersonal->curso && $itempersonal->curso->grado ? mb_strtoupper($itempersonal->curso->grado->nombre_grado) : ''}}
                </td>
                <td>
                    {{$itempersonal->curso && $itempersonal->curso->grado && $itempersonal->curso->grado->nivel ? mb_strtoupper($itempersonal->curso->grado->nivel->nombre_nivel) : ''}}
                </td>
                --}}
                <td><a href="{{ route('Personal.edit',$itempersonal->id_personal)}}" class="btn btn-info">
                        <img src="{{ asset('plantilla\src\img\logo\editar_blanco.png')}}" alt="Editar" style="width: 30px; height: 30px;">
                    </a>
                    <a href="{{ route('Personal.confirmar',$itempersonal->id_personal)}}" class="btn btn-danger">
                        <img src="{{ asset('plantilla\src\img\logo\eliminar.png')}}" alt="Eliminar" style="width: 30px; height: 30px;">
                    </a>
                </td>
            </tr>
            @endforeach
            @endif
    </tbody>
</table>
{{ $personal->appends(['buscarporNombre' => $buscarporNombre,'buscarporApellido' => $buscarporApellido,'buscarporTipoPersonal' => $buscarporTipoPersonal])->links() }}
@endsection('Contenido')
@section('script')
<script>
    setTimeout(function() {
        document.querySelector('#mensaje').remove();
    }, 3000);
</script>
@endsection('script')