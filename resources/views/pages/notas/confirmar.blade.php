@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    @include('components.confirm_deletion', [
        'tag_item' => 'nota', 
        'field_item' => $nota->id,
        'delete_route' => route('notas.destroy', $nota->id),
        'cancelar_route' => route('CancelarNotas')
    ])
@endsection
