@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Perfiles</h1>
    <br>
    <nav class="navbar navbar-light">
        <a class="btn btn-primary " href="{{ route('admin.perfil.create') }}">
            <i class="fas fa-plus"></i> Nuevo Perfil
        </a>
        <form class="form-inline my-lg-0" method="GET" action="{{ route('admin.perfil.index') }}">
            <div class="d-flex align-items-center">
                <input name="buscarpor" class="form-control mr-sm-2" type="search" style="width: 350px;"
                    placeholder="Ingrese nombre del rol" aria-label="Search" value="">
                <button class="btn btn-success" type="submit">Buscar</button>
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
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="w-25">Id</th>
                <th scope="col">Rol</th> <!-- Nueva columna para Rol -->
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($roles) <= 0)
                <tr>
                    <td colspan="3">No hay registros</td>
                </tr>
            @else
                @foreach ($roles as $rol)
                    <tr>
                        <td>{{ $rol->id }}</td>
                        <td>{{ $rol->name }}</td>
                        <td>
                            <a href="" class="btn btn-info">
                                <img src="{{ asset('plantilla/src/img/logo/editar_blanco.png') }}" alt="Editar"
                                    style="width: 30px; height: 30px;">
                            </a>
                            <a href="" class="btn btn-danger">
                                <img src="{{ asset('plantilla\src\img\logo\eliminar.png') }}" alt="Eliminar"
                                    style="width: 30px; height: 30px;">
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@endsection