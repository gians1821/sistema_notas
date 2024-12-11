@extends('layout.plantilla')

@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
    <!-- Gestión de Capacidades -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Notas</h1>
    <br>
    <nav class="navbar navbar-light">
        
    </nav>

    @include('components.session_messages')
    <br>

    @include('components.items_table', [
        'data' => $notas, // Los elementos a mostrar en la tabla
        'headers' => [
            'Id',
            'Alumno',
            'Curso',
            'Competencia',
            'Nota 1',
            'Nota 2',
            'Nota 3',
            'Nota Final',
            'Acciones',
        ], // Los títulos de las columnas
        'columns_data' => [
            'id',
            'nombre_alumno',
            'nombre_curso',
            'nombre_competencia',
            'nota1',
            'nota2',
            'nota3',
            'nota_final',
        ], // Las propiedades de los modelos a mostrar
        'edit_route' => 'notas.edit', // Ruta para editar
        'delete_route' => 'notas.confirmar', // Ruta para eliminar
    ])
@endsection
