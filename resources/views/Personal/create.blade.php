@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Registro de Personal -->
    <h1 class="h3 mb-3"><strong>Registro</strong> de Personal</h1>
    <form method="POST" action="{{ route('Personal.store') }}">
        @csrf

        <div class="row mb-4">
            <div class="card col-6 mr-4">
                <div class="card-header">
                    <h3 class="card-title">Datos Personales</h3>
                </div>
                <div class="card-body">
                    <!--DNI-->
                    <div class="row">
                        <div class="col-4">
                            @include('components.text_input', [
                                'label' => 'DNI',
                                'name' => 'dni',
                                'class' => 'form-control',
                            ])
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <!--NOMBRE-->
                            @include('components.text_input', [
                                'label' => 'Nombre',
                                'name' => 'nombre',
                                'class' => 'form-control',
                            ])
                        </div>
                        <div class="col-6">
                            <!--APELLIDO-->
                            @include('components.text_input', [
                                'label' => 'Apellido',
                                'name' => 'apellido',
                                'class' => 'form-control',
                            ])
                        </div>
                    </div>

                    <!--DIRECCION-->
                    @include('components.text_input', [
                        'label' => 'Dirección',
                        'name' => 'direccion',
                        'class' => 'form-control',
                    ])

                    <div class="row">
                        <div class="col-5">
                            <!--FECHA DE NACIMIENTO-->
                            @include('components.date_input', [
                                'label' => 'Fecha de Nacimiento',
                                'name' => 'fecha_nacimiento',
                                'class' => 'form-control',
                            ])
                        </div>
                        <div class="col-7">
                            <!--TELEFONO-->
                            @include('components.text_input', [
                                'label' => 'Teléfono',
                                'name' => 'telefono',
                                'class' => 'form-control',
                            ])
                        </div>
                    </div>

                    <!--TIPO DE PERSONAL-->
                    @include('components.select_input', [
                        'label' => 'Tipo de Personal',
                        'name' => 'id_tipo_personal',
                        'options' => $tipos_personal,
                        'property' => 'nombre_tipopersonal',
                        'id_property' => 'id_tipo_personal',
                        'class' => 'form-control',
                    ])
                </div>
            </div>

            <div class="card col-5">
                <div class="card-header">
                    <h3 class="card-title">Creación de Usuario</h3>
                </div>
                <div class="card-body">
                    <!-- campo para nombre de usuario (name) -->
                    @include('components.text_input', [
                        'label' => 'Nombre de Usuario',
                        'name' => 'username',
                    ])

                    <!-- campo para email -->
                    @include('components.text_input', [
                        'label' => 'Correo Electrónico',
                        'name' => 'email',
                    ])

                    <!-- campo para password -->
                    @include('components.password_input', [
                        'label' => 'Contraseña',
                        'name' => 'password',
                    ])

                    <!-- campo para password -->
                    @include('components.password_input', [
                        'label' => 'Confirmar Contraseña',
                        'name' => 'password_confirmation',
                    ])
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        <a href="{{ route('CancelarPersonal') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
@endsection
