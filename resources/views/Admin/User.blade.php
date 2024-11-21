@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> usuarios</h1>
    <br>
    <nav class="navbar navbar-light">
        <a class="btn btn-primary " href="{{ route('admin.usuarios.create') }}">
            <i class="fas fa-plus"></i> Nuevo Registro
        </a>
        <form class="form-inline my-lg-0" method="GET" action="{{ route('admin.usuarios.index') }}">
            <div class="d-flex align-items-center">
                <input name="buscarpor" class="form-control w-100 mr-sm-2" type="search"
                    placeholder="Ingrese nombre o correo de un Usuario" aria-label="Search" value="{{ $buscarpor }}">
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
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="w-25">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th> <!-- Nueva columna para Rol -->
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($users) <= 0)
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                {{ $role->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="btn btn-info">
                                <img src="{{ asset('plantilla/src/img/logo/editar_blanco.png') }}" alt="Editar"
                                    style="width: 30px; height: 30px;">
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $users->appends(['buscarpor' => $buscarpor])->links() }}

@endsection
