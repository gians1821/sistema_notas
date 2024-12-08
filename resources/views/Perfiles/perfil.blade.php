@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Perfiles</h1>
    <br>
    <nav class="navbar navbar-light">

        @can('Admin.perfiles.create')
        <a class="btn btn-primary " href="{{ route('admin.perfil.create') }}">
            <i class="fas fa-plus"></i> <strong> Nuevo Registro </strong>
        </a>
        @endcan

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
@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 3000);
    </script>
@endsection