@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Registro de Personal -->
    <h1 class="h3 mb-3"><strong>Editar</strong> Personal</h1>
    <form method="POST" action="{{ route('Personal.update', $personal->id_personal) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="">Id PERSONAL</label>
            <input type="text" class="form-control" id="id_personal" name="id_personal" value="{{ $personal->id_personal }}"
                disabled>
        </div>

        <input type="hidden" name="dni" value="{{ $personal->dni }}">
        <input type="hidden" name="nombre" value="{{ $personal->nombre }}">
        <input type="hidden" name="apellido" value="{{ $personal->apellido }}">
        <input type="hidden" name="fecha_nacimiento" value="{{ $personal->fecha_nacimiento }}">
        <input type="hidden" name="nivel" value="{{ $personal->nivel }}">
        <input type="hidden" name="grado" value="{{ $personal->grado }}">
        <input type="hidden" name="curso" value="{{ $personal->curso }}">
        <!--DNI-->
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control @error('dni') is-invalid @enderror " id="dni" name="dni"
                value="{{ $personal->dni }}" disabled>
            @error('dni')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!--NOMBRE-->
        <div class="form-group">
            <label for="nombre">NOMBRE</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                value="{{ $personal->nombre }}" value="{{ old('nombre') }}" disabled>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!--APELLIDO-->
        <div class="form-group">
            <label for="apellido">APELLIDO</label>
            <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
                name="apellido" value="{{ $personal->apellido }}" value="{{ old('apellido') }}" disabled>
            @error('apellido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!--FECHA DE NACIMIENTO-->
        <div class="form-group">
            <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento"
                name="fecha_nacimiento" value="{{ $personal->fecha_nacimiento }}" value="{{ old('fecha_nacimiento') }}"
                disabled>
            @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!--DIRECCION-->
        <div class="form-group">
            <label for="direccion">DIRECCION</label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                name="direccion" value="{{ $personal->direccion }}" value="{{ old('direccion') }}">
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!--TELEFONO-->
        <div class="form-group">
            <label for="telefono">TELÉFONO</label>
            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                name="telefono" value="{{ $personal->telefono }}" value="{{ old('telefono') }}">
            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!--TIPO DE PERSONAL-->
        <div class="form-group">
            <label for="id_tipo_personal">TIPO PERSONAL</label>
            <select class="form-control @error('id_tipo_personal') is-invalid @enderror" id="id_tipo_personal"
                name="id_tipo_personal">
                @error('id_tipo_personal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="TIPO DE PERSONAL" selected disabled>SELECCIONE</option>
                <option value="DOCENTE">DOCENTE</option>
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                <option value="DIRECTOR">DIRECTOR</option>
                <option value="ASISTENTE">ASISTENTE</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        <a href="{{ route('CancelarPersonal') }}" class="btn btn-danger"><i class="fas fa-ban"></i>
            Cancelar</button></a>
    </form>
@endsection
