<!-- resources/views/notas/edit.blade.php -->
@extends('layout.plantilla') <!-- Asegúrate de que estás extendiendo el layout correcto -->

@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
<div class="container">
    <h1>Editar Nota</h1>

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de edición -->
    <form action="{{ route('notas.update', $nota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos no editables -->

        <!-- Nombre del Curso -->
        <div class="form-group">
            <label for="nombre_curso"><strong>Curso</strong></label>
            <input type="text" class="form-control" id="nombre_curso" name="nombre_curso"
                value="{{ $nota->nombre_curso }}" readonly>
        </div>

        <!-- Nombre del Alumno -->
        <div class="form-group">
            <label for="nombre_alumno"><strong>Alumno</strong></label>
            <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno"
                value="{{ $nota->nombre_alumno }}" readonly>
        </div>

        <!-- Nombre de la Competencia -->
        <div class="form-group">
            <label for="nombre_competencia"><strong>Competencia</strong></label>
            <input type="text" class="form-control" id="nombre_competencia" name="nombre_competencia"
                value="{{ $nota->nombre_competencia }}" readonly>
        </div>

        <!-- Campos Editables -->

        <!-- Nota 1 -->
        @include('components.text_input', [
            'name' => 'nota1',
            'label' => 'Nota 1',
            'attributes' => 'required maxlength="10"',
            'value' => $nota->nota1
        ])

        <!-- Nota 2 -->
        @include('components.text_input', [
            'name' => 'nota2',
            'label' => 'Nota 2',
            'attributes' => 'required maxlength="10"',
            'value' => $nota->nota2
        ])

        <!-- Nota 3 -->
        @include('components.text_input', [
            'name' => 'nota3',
            'label' => 'Nota 3',
            'attributes' => 'required maxlength="10"',
            'value' => $nota->nota3
        ])

        <!-- Nota Final -->
        @include('components.text_input', [
            'name' => 'nota_final',
            'label' => 'Nota Final',
            'attributes' => 'required maxlength="10"',
            'value' => $nota->nota_final
        ])

        <!-- Botón de Envío -->
        <button type="submit" class="btn btn-primary">Actualizar Nota</button>
    </form>
</div>
@endsection
