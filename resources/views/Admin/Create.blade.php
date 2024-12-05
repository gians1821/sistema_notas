@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Asignar un</strong> Rol</h1>
    <br>
    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf
        <div class="card">
            <div class="card-body">
                @include('components.text_input', [
                    'label' => 'Nombre',
                    'name' => 'name',
                ])

                @include('components.text_input', [
                    'label' => 'Email',
                    'name' => 'email',
                ])

                @include('components.password_input', [
                    'label' => 'Contraseña',
                    'name' => 'password',
                ])
                
                @include('components.select_input', [
                    'label' => 'Listado de roles',
                    'name' => 'rol',
                    'options' => $roles,
                    'selected' => 0,
                ])

                <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save"></i> Registrar</button>
                <a href="{{ route('CancelarUsuario') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i>
                    Cancelar</button></a>

            </div>
        </div>
    </form>
@endsection
