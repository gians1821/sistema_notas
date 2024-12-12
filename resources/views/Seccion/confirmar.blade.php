@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Confirmar eliminacion de Registro-->
    <h1 class="h3 mb-3"><strong>Eliminar</strong> Seccion</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">¿Estas seguro de eliminar esta sección?</h5>
            <form action="{{ route('Seccion.destroy', $seccion->id_seccion) }}" method="POST">
                <h5>{{ $seccion->grado->nombre_grado }} "{{ $seccion->nombre_seccion }}" de
                    {{ $seccion->grado->nivel->nombre_nivel }} </h5>
                @method('delete')
                @csrf
                <p class="card-text">No podras recuperar la informacion una vez eliminada.</p>
                <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI </button>
                <a href="{{ route('CancelarSeccion') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i>
                    NO</button></a>
            </form>
        </div>
    </div>
@endsection
