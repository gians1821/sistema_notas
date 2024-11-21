@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Registro de Alumnos -->
    <h1 class="h3 mb-3"><strong>Registro</strong> Nota</h1>
    <form method="POST"
        action="{{ route('Nota.update', ['id_alumno' => $nota->alumno->id_alumno, 'id_curso' => $nota->curso->id_curso]) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="">Alumno(a)</label>
                <input type="text" class="form-control" id="alumno_id_alumno" name="alumno_id_alumno"
                    value="{{ $nota->alumno->nombre_alumno . ' ' . $nota->alumno->apellido_alumno }}" disabled>
            </div>
            <div class="form-group">
                <label for="">Curso</label>
                <input type="text" class="form-control" id="curso_id_curso" name="curso_id_curso"
                    value="{{ $nota->curso->nombre_curso }}" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="nota1">Nota 1</label>
            <input type="text" class="form-control @error('nota1') is-invalid @enderror " id="nota1" name="nota1"
                value="{{ $nota->nota1 }}">
            @error('nota1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="nota2">Nota 2</label>
            <input type="text" class="form-control @error('nota2') is-invalid @enderror " id="nota2" name="nota2"
                value="{{ $nota->nota2 }}">
            @error('nota2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="nota3">Nota 3</label>
            <input type="text" class="form-control @error('nota3') is-invalid @enderror " id="nota3" name="nota3"
                value="{{ $nota->nota3 }}">
            @error('nota3')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        <a href="{{ route('Catedra.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
@endsection
