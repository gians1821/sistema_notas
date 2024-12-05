@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    @include('components.confirm_deletion', [
        'tag_item' => 'usuario', 
        'field_item' => $user->name,
        'delete_route' => route('admin.usuarios.destroy', $user->id),
        'cancelar_route' => route('CancelarUsuario')
    ])
@endsection
