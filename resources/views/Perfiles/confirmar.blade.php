@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    @include('components.confirm_deletion', [
        'tag_item' => 'perfil', 
        'field_item' => $rol->name,
        'delete_route' => route('admin.perfil.destroy', $rol->id),
        'cancelar_route' => route('CancelarPerfil')
    ])
@endsection
