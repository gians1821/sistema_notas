@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Usuarios</h1>
    <br>
    <nav class="navbar navbar-light">

        @can('Crear Usuarios')
        <a class="btn btn-primary " href="{{ route('admin.usuarios.create') }}">
            <i class="fas fa-plus"></i> <strong> Nuevo Registro </strong>
        </a>
        @endcan

        <form class="form-inline my-lg-0" method="GET" action="{{ route('admin.usuarios.index') }}">
            <div class="d-flex align-items-center">
                <input name="buscarpor" class="form-control mr-sm-2" type="search" style="width: 300px;"
                    placeholder="Ingrese nombre o correo de un Usuario" aria-label="Search" value="{{ $buscarpor }}">
                
                <select name="rol" class="form-control mr-sm-2" style="width: 300px";>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $filtrarPorRol == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-success" type="submit" style="width: 100px;"><strong> Buscar </strong></button>
            </div>
        </form>
    </nav>

    <div id="mensaje1">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{ session('datos') }}
                <button type="button" class="close" data-dismiss="alert" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div id="mensaje2">
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('danger') }}
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
                            {{ $user->roles->first()->name ?? 'No tiene rol' }}
                        </td>
                        <td>

                            @can('Editar Usuarios')
                            <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="btn btn-info">
                                <img src="{{ asset('plantilla/src/img/logo/editar_blanco.png') }}" alt="Editar"
                                    style="width: 30px; height: 30px;">
                            </a>
                            @endcan

                            @can('Eliminar Usuarios')
                            <a href="{{ route('admin.usuarios.confirmar', $user->id) }}" class="btn btn-danger">
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
    
    {{ $users->appends(['buscarpor' => $buscarpor, 'rol' => $filtrarPorRol])->links() }}

@endsection
@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje1').remove();
        }, 3000);
    </script>
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje2').remove();
        }, 3000);
    </script>
@section('script')