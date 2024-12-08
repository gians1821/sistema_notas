

@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    @include('components.confirm_deletion', [
        'tag_item' => 'Alumno', 
        'field_item' => $alumnos->nombre_alumno . ' ' . $alumnos->apellido_alumno,
        'delete_route' => '/Alumno/' . $alumnos->id_alumno,
        'cancelar_route' => route('Cancelar')
    ])
@endsection
