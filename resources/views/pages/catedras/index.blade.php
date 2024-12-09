@extends('layout.plantilla')

@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
    <!-- Gestión de Capacidades -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Cátedras</h1>
    <br>
    <nav class="navbar navbar-light">
        @role('Admin')
            <a class="btn btn-primary" href="{{ route('catedras.create') }}">
                <i class="fas fa-plus"></i> Asignar Docente a Cátedra
            </a>
        @endrole
    </nav>

    @include('components.session_messages')
    <br>

    
@endsection
