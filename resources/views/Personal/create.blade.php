@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Registro de Personal -->
    <h1 class="h3 mb-3"><strong>Registro</strong> Personal</h1>
    <form method="POST" action="{{ route('Personal.store') }}">
        @csrf
        <!--DNI-->
        @include('components.text_input', [
            'label' => 'DNI',
            'name' => 'dni'
        ])
        
        <!--NOMBRE-->
        @include('components.text_input', [
            'label' => 'Nombre',
            'name' => 'nombre'
        ])

        <!--APELLIDO-->
        @include('components.text_input', [
            'label' => 'Apellido',
            'name' => 'apellido'
        ])

        <!--DIRECCION-->
        @include('components.text_input', [
            'label' => 'Dirección',
            'name' => 'direccion'
        ])

        <!--FECHA DE NACIMIENTO-->
        @include('components.date_input', [
            'label' => 'Fecha de Nacimiento',
            'name' => 'fecha_nacimiento'
        ])

        <!--TELEFONO-->
        @include('components.text_input', [
            'label' => 'Teléfono',
            'name' => 'telefono'
        ])
        
        <!--TIPO DE PERSONAL-->
        @include('components.select_input', [
            'label' => 'Tipo de Personal',
            'name' => 'id_tipo_personal',
            'options' => $tipos_personal,
            'property' => 'nombre_tipopersonal',
            'id_property' => 'id_tipo_personal'
        ])
        
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        <a href="{{ route('CancelarPersonal') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
@endsection
