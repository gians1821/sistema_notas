@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Cursos</h1>
    <br>
    <nav class="navbar navbar-light ">
        @can('Crear Cusos')
        <a class="btn btn-primary " href="{{ route('Curso.create') }}">
            <i class="fas fa-plus"></i> Nuevo Registro
        </a>
        @endcan
        <form class="form-inline my-2 my-lg-0" method="GET">
            <div class="input-group ">
                <input name="buscarporNombre" class="form-control mr-sm-2" type="search" placeholder="Nombre"
                    aria-label="Search" value="{{ $buscarporNombre }}">
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
                <th scope="col" class="w-25">CURSO_ID</th>
                <th scope="col">GRADO</th>
                <th scope="col">NIVEL</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @if (count($curso) <= 0)
                <tr>
                    <td colspan="3">No hay registros</td>
                </tr>
            @else
                @foreach ($curso as $itemcurso)
                    <tr>
                        <td>{{ $itemcurso->id_curso }}</td>
                        <td>{{ $itemcurso->grado ? $itemcurso->grado->nombre_grado : 'No asignado' }}</td>
                        <td>{{ $itemcurso->grado && $itemcurso->grado->nivel ? $itemcurso->grado->nivel->nombre_nivel : 'No asignado' }}
                        </td> <!-- Asegúrate de ajustar 'nombre_nivel' según el nombre real del campo en tu modelo Nivel -->
                        <td>{{ mb_strtoupper($itemcurso->nombre_curso) }}</td>
                        <td>
                            @can('Editar Cursos')
                                <a href="{{ route('Curso.edit', $itemcurso->id_curso) }}" class="btn btn-info">
                                    <img src="{{ asset('plantilla\src\img\logo\editar_blanco.png') }}" alt="Editar"
                                        style="width: 30px; height: 30px;">
                                </a>
                            @endcan

                            @can('Eliminar Cursos')
                                <a href="{{ route('Curso.confirmar', $itemcurso->id_curso) }}" class="btn btn-danger">
                                    <img src="{{ asset('plantilla\src\img\logo\eliminar.png') }}" alt="Eliminar"
                                        style="width: 30px; height: 30px;">
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $curso->appends(['buscarporNombre' => $buscarporNombre])->links() }}
@endsection('Contenido')
@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 3000);
    </script>
@endsection('script')
