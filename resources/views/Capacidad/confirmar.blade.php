@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Confirmar eliminacion de Registro-->
    <h1 class="h3 mb-3"><strong>Eliminar</strong> Capacidad</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">¿Estas seguro de eliminar esta competencia?</h5>
            <form action="{{ route('Capacidad.destroy', $capacidad->id_competencia) }}" method="POST">
                <h5>{{ $capacidad->nombre_competencia }} </h5>
                <br>
                <h6>CURSO: {{ mb_strtoupper($capacidad->curso->nombre_curso) }} </h6>
                <!--mb_strtoupper PARA PASAR A MAYUS. CON TILDE-->
                <h6>PERTENECE: {{ $capacidad->curso->grado->nombre_grado }} DE
                    {{ $capacidad->curso->grado->nivel->nombre_nivel }}</h6>
                @method('delete')
                @csrf
                <p class="card-text">No podras recuperar la informacion una vez eliminada.</p>
                <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI </button>
                <a href="{{ route('CancelarCapacidad') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i>
                    NO</button></a>
            </form>
        </div>
    </div>
@endsection
