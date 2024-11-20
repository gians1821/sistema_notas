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
<h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> alumnos</h1>
<br>
<nav class="navbar navbar-light">

    @role('Admin')
    <a href="{{route('Alumno.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
    @endrole

    <form class="form-inline my-2 my-lg-0" method="GET">
        <div class="input-group">
            <!-- Campo de búsqueda por nombre -->
            <input name="buscarporNom" class="form-control mr-2" type="search" placeholder="Nombre" aria-label="Search" value="{{ request('buscarporNom') }}">

            <!-- Campo de búsqueda por apellido -->
            <input name="buscarporApell" class="form-control mr-2" type="search" placeholder="Apellido" aria-label="Search" value="{{ request('buscarporApell') }}">

            <!-- Selección de nivel con envío automático -->
            <select class="form-control ml-2 mr-2" id="nivel" name="nivel" onchange="this.form.submit()">
                <option value="" selected>Nivel</option>
                @foreach($niveles as $itemniveles)
                <option value="{{ $itemniveles->id_nivel }}" {{ request('nivel') == $itemniveles->id_nivel ? 'selected' : '' }}>
                    {{ $itemniveles->nombre_nivel }}
                </option>
                @endforeach
            </select>

            <!-- Selección de grado -->
            <select class="form-control ml-2 mr-2" id="grado" name="grado" onchange="this.form.submit()">
                <option value="" selected>Grado</option>
                <!-- Agrega opciones de grado dinámicamente o manualmente -->
                @foreach(App\Models\Grado::where('id_nivel', $nivel)->get() as $grado)
                <option value="{{ $grado->id_grado }}" {{ request('grado') == $grado->id_grado ? 'selected' : '' }}>
                    {{ $grado->nombre_grado }}
                </option>
                @endforeach
            </select>

            <!-- Selección de sección -->
            <select class="form-control ml-2 mr-2" id="seccion" name="seccion" onchange="this.form.submit()">
                <option value="" selected>Sección</option>
                <!-- Agrega opciones de sección dinámicamente o manualmente -->
                @foreach(App\Models\Seccion::where('grado_id_grado', request('grado'))->get() as $seccion)
                <option value="{{ $seccion->id_seccion }}" {{ request('seccion') == $seccion->id_seccion ? 'selected' : '' }}>
                    {{ $seccion->nombre_seccion }}
                </option>
                @endforeach
            </select>

            <!-- Botón de búsqueda -->
            <div class="input-group-append ml-2 mr-4">
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
            <th scope="col" class="w-25">Id Alumno</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($alumnos)<=0) <tr>
            <td colspan="3">No hay registros</td>
            </tr>
            @else
            @foreach($alumnos as $itemalumnos)
            <tr>
                <td>
                    {{$itemalumnos->id_alumno}}
                </td>
                <td>
                    {{$itemalumnos->nombre_alumno}}
                </td>
                <td>
                    {{$itemalumnos->apellido_alumno}}
                </td>
                <td>

                    @role('Admin')
                    <a href="{{ route('Alumno.edit',$itemalumnos->id_alumno)}}" class="btn btn-info">
                        <img src="{{ asset('plantilla\src\img\logo\editar_blanco.png')}}" alt="Editar" style="width: 30px; height: 30px;">
                    </a>

                    <a href="{{ route('Alumno.confirmar',$itemalumnos->id_alumno)}}" class="btn btn-danger">
                        <img src="{{ asset('plantilla\src\img\logo\eliminar.png')}}" alt="Eliminar" style="width: 30px; height: 30px;">
                    </a>
                    @endrole

                </td>
            </tr>
            @endforeach
            @endif
    </tbody>
</table>

<div class="d-flex justify-content-between">
    <div>
        {{ $alumnos->appends(['buscarporNom' => $buscarporNom, 'buscarporApell' => $buscarporApell])->links() }}
    </div>
    <div>
        <form action="{{ route('Alumno.generarPdf', [
            'idseccion' => $seccion ? $seccion->id_seccion : '0' // Usa '0' si $seccion es nulo
        ]) }}" method="POST" target="_blank">
            @csrf
            <button type="submit" class="btn btn-secondary">Generar PDF</button>
        </form>
    </div>
</div>

@endsection('Contenido')
@section('script')
<script>
    setTimeout(function() {
        document.querySelector('#mensaje').remove();
    }, 3000);
</script>

@endsection