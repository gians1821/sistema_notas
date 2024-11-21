@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Confirmar eliminacion de Registro-->
    <h1 class="h3 mb-3"><strong>Eliminar</strong> Registro</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">¿Estas seguro de eliminar el registro?</h5>
            <form action="{{ route('Alumno.destroy', $alumnos->id_alumno) }}" method="POST">
                <h5>Codigo: {{ $alumnos->id_alumno }}</h5>
                <h5>Alumno(a): {{ $alumnos->nombre_alumno }} {{ $alumnos->apellido_alumno }}</h5>
                @method('delete')
                @csrf
                <p class="card-text">No podras recuperar la informacion una vez eliminada.</p>
                <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI </button>
                <a href="{{ route('Cancelar') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i>
                    NO</button></a>
            </form>
        </div>
    </div>
@endsection
