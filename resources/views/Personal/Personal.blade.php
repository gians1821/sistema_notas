@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Personal</h1>
    <br>
    <nav class="navbar navbar-light ">
        @can('Crear Docente')
            <a class="btn btn-primary " href="{{ route('Personal.create') }}">
                <i class="fas fa-plus"></i> Nuevo Registro
            </a>
        @endcan
        <form class="form-inline my-lg-0 m-2" method="GET">
            <div class="input-group ">
                <select class="form-control w-auto mr-4" id="tipopersonal" name="buscarporTipoPersonal">
                    <option value="TipoPersonal" selected disabled>SELECCIONE TIPO DE PERSONAL</option>
                    <option value="DOCENTE">DOCENTE</option>

                </select>
                <input name="buscarporNombre" class="form-control mr-sm-2" type="search" placeholder="NOMBRE"
                    aria-label="Search">
                <input name="buscarporApellido" class="form-control mr-sm-2" type="search" placeholder="APELLIDO"
                    aria-label="Search">
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
            @if (count($personal) <= 0)
                <tr>
                    <td colspan="3">No hay registros</td>
                </tr>
            @else
                @foreach ($personal as $itempersonal)
                    <tr>
                        <td>
                            {{ $itempersonal->id_personal }}
                        </td>
                        <td>
                            {{ mb_strtoupper($itempersonal->nombre) }}
                        </td>
                        <td>
                            {{ mb_strtoupper($itempersonal->apellido) }}
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

                    @can('Editar Docente')
                        <td><a href="{{ route('Personal.edit', $itempersonal->id_personal) }}" class="btn btn-info">
                                <img src="{{ asset('plantilla\src\img\logo\editar_blanco.png') }}" alt="Editar"
                                    style="width: 30px; height: 30px;">
                            </a>
                    @endcan

                    @can('Eliminar Docente')
                            <a href="{{ route('Personal.confirmar', $itempersonal->id_personal) }}" class="btn btn-danger">
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
    {{ $personal->appends(['buscarporNombre' => $buscarporNombre, 'buscarporApellido' => $buscarporApellido, 'buscarporTipoPersonal' => $buscarporTipoPersonal])->links() }}
@endsection('Contenido')
@section('script')
    <script>
        
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 3000);
    </script>
@endsection('script')
