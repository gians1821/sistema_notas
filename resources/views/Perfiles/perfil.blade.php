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

    @include('components.items_table', [
        'data' => $roles,  // Los elementos a mostrar en la tabla
        'headers' => ['Id', 'Rol', 'Acciones'],  // Los títulos de las columnas
        'columns_data' => ['id', 'name'],  // Las propiedades de los modelos a mostrar
        'edit_route' => 'admin.perfil.edit',  // Ruta para editar
        'delete_route' => 'admin.perfil.confirmar'  // Ruta para eliminar
    ])

@endsection
