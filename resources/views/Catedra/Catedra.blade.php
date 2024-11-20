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
@endsection('BarraNavegacion')
@section('Contenido')
<!-- CONTENIDO DE LA PAGINA -->
<h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> notas</h1>
<br>

<form class="form-inline my-2 my-lg-0" method="GET">
    <div class="input-group">

        <select class="form-control ml-2 mr-2" id="nivel" name="nivel" onchange="this.form.submit()">
            <option value="" selected>Nivel</option>
            @foreach($nivel as $itemniveles)
            <option value="{{ $itemniveles->id_nivel }}" {{ request('nivel') == $itemniveles->id_nivel ? 'selected' : '' }}>
                {{ $itemniveles->nombre_nivel }}
            </option>
            @endforeach
        </select>

        <select class="form-control ml-2 mr-2" id="grado" name="grado" onchange="this.form.submit()">
            <option value="" selected>Grado</option>
            @foreach($grado as $itemgrados)
            <option value="{{ $itemgrados->id_grado }}" {{ request('grado') == $itemgrados->id_grado ? 'selected' : '' }}>
                {{ $itemgrados->nombre_grado }}
            </option>
            @endforeach
        </select>

        <select class="form-control ml-2 mr-2" id="curso" name="curso">
            <option value="" selected>Curso</option>
            @foreach($cursos as $itemcurso)
            <option value="{{ $itemcurso->id_curso }}" {{ request('curso') == $itemcurso->id_curso ? 'selected' : '' }}>
                {{ $itemcurso->nombre_curso }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="input-group-append ml-2 mr-4">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
    </div>
</form>
<br>
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
            <th scope="col">Alumno</th>
            <th scope="col" class="w-25">Curso</th>
            <th scope="col">Nota 1</th>
            <th scope="col">Nota 2</th>
            <th scope="col">Nota 3</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($notas)<=0) <tr>
            <td colspan="3">No hay registros</td>
            </tr>
            @else
            @foreach($notas as $nota)
            <tr>
                <td>
                    {{$nota->alumno->nombre_alumno}} {{$nota->alumno->apellido_alumno}}
                </td>
                <td>
                    {{$nota->curso->nombre_curso}}
                </td>
                <td>
                    {{$nota->nota1}}
                </td>
                <td>
                    {{$nota->nota2}}
                </td>
                <td>
                    {{$nota->nota3}}
                </td>
                <td>
                    @role('Docente')
                    <a href="{{ route('Nota.edit', ['id_alumno' => $nota->alumno_id_alumno, 'id_curso' => $nota->curso_id_curso])}}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                    @endrole
                    @role('Admin')
                    <a href="{{ route('Nota.edit', ['id_alumno' => $nota->alumno_id_alumno, 'id_curso' => $nota->curso_id_curso])}}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                    @endrole
                    <a href="{{ route('Catedra.pdfalumno', ['id_alumno' => $nota->alumno_id_alumno]) }}" class="btn btn-secondary" target="_blank">PDF</a>
                </td>
            </tr>
            @endforeach
            @endif
    </tbody>

</table>
<div class="d-flex justify-content-between">
    <div>
        {{ $notas->appends(['curso' => $cursoId])->links() }}
    </div>
    <div>
        <a href="{{route('Catedra.pdf', ['curso' => $cursoId])}}" class="btn btn-secondary" target="_blank">Generar PDF</a>
    </div>
</div>

@endsection('Contenido')