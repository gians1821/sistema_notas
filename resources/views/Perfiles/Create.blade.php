@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Crear un</strong> Rol</h1>
    <br>
    <form method="POST" action="{{ route('admin.perfil.store') }}">
        @csrf
        <div class="card">
            <div class="card-body">
                @include('components.text_input', [
                    'label' => 'Nombre del Rol',
                    'name' => 'name'
                ])

                <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save"></i> Registrar</button>
                <a href="{{ route('CancelarPerfil') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i>
                    Cancelar</button></a>

            </div>
        </div>
    </form>
@endsection
