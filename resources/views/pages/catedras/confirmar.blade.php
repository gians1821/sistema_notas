@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    @include('components.confirm_deletion', [
        'tag_item' => 'catedra', 
        'field_item' => $catedra->id,
        'delete_route' => route('catedras.destroy', $catedra->id),
        'cancelar_route' => route('CancelarCatedras')
    ])
@endsection
