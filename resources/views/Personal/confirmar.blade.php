@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Confirmar eliminacion de Registro-->
    <h1 class="h3 mb-3"><strong>Eliminar</strong> Personal</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">¿Estas seguro de eliminar?</h5>
            <form action="{{ route('Personal.destroy', $personal->id_personal) }}" method="POST">
                <h5>DNI: {{ $personal->dni }}</h5>
                <h5>{{ mb_strtoupper($personal->tipopersonal->nombre_tipopersonal) }}: {{ $personal->nombre }}
                    {{ $personal->apellido }} </h5>
                <h5>USUARIO ASOCIADO: {{ $personal->user->email }} </h5>

                @method('delete')
                @csrf
                <p class="card-text">No podras recuperar la informacion una vez eliminada.</p>
                <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI </button>
                <a href="{{ route('CancelarPersonal') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i>
                    NO</button></a>
            </form>
        </div>
    </div>
@endsection
