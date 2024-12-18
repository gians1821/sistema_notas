@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Lista de </strong>Alumnos Matriculados</h1>
    <br>
    <nav class="navbar navbar-light">
        @can('Crear Alumnos')
            <a href="{{ route('Alumno.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i><strong> Nuevo Registro </strong></a>
        @endcan

        <form class="form-inline my-2 my-lg-0" method="GET">
            <div class="input-group">

                <select class="form-control ml-2 mr-2" style="width: 150px;" id="periodo" name="periodo">
                    <option value="" selected>Periodo</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->name }}" {{ request('periodo') == $periodo->name ? 'selected' : '' }}>
                            {{ $periodo->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Campo de búsqueda por nombre -->
                <input name="buscarporNom" class="form-control mr-2" style="width: 170px;" type="search" placeholder="Nombre" aria-label="Search"
                    value="{{ request('buscarporNom') }}">

                <!-- Campo de búsqueda por apellido -->
                <input name="buscarporApell" class="form-control mr-2" style="width: 170px;" type="search" placeholder="Apellido"
                    aria-label="Search" value="{{ request('buscarporApell') }}">

                <!-- Selección de nivel con envío automático -->
                <div class="position-relative">
                    <select class="form-control ml-2 mr-2 @error('nivel') is-invalid @enderror" style="width: 150px;" id="nivel" name="nivel" onchange="this.form.submit()">
                        <option value="" selected>Nivel</option>
                        @foreach ($niveles as $itemniveles)
                            <option value="{{ $itemniveles->id_nivel }}"
                                {{ request('nivel') == $itemniveles->id_nivel ? 'selected' : '' }}>
                                {{ $itemniveles->nombre_nivel }}
                            </option>
                        @endforeach
                    </select>
                    @error('nivel')
                        <div class="invalid-feedback d-flex justify-content-center align-items-center">
                            <strong>
                                {{ $message }}
                            </strong>
                        </div>
                    @enderror
                </div>

                <!-- Selección de grado -->
                <div class="position-relative">
                    <select class="form-control ml-2 mr-2 @error('grado') is-invalid @enderror" style="width: 150px;" id="grado" name="grado" onchange="this.form.submit()">
                        <option value="" selected>Grado</option>
                        <!-- Agrega opciones de grado dinámicamente o manualmente -->
                        @foreach (App\Models\Grado::where('id_nivel', $nivel)->get() as $grado)
                            <option value="{{ $grado->id_grado }}" {{ request('grado') == $grado->id_grado ? 'selected' : '' }}>
                                {{ $grado->nombre_grado }}
                            </option>
                        @endforeach
                    </select>
                    @error('grado')
                        <div class="invalid-feedback d-flex justify-content-center align-items-center">
                            <strong>
                                {{ $message }}
                            </strong>
                        </div>
                    @enderror
                </div>

                <!-- Selección de sección -->
                <div class="position-relative">
                    <select class="form-control ml-2 mr-2 @error('seccion') is-invalid @enderror"" style="width: 150px;" id="seccion" name="seccion" onchange="this.form.submit()">
                        <option value="" selected>Sección</option>
                        <!-- Agrega opciones de sección dinámicamente o manualmente -->
                        @foreach (App\Models\Seccion::where('grado_id_grado', request('grado'))->get() as $seccion)
                            <option value="{{ $seccion->id_seccion }}"
                                {{ request('seccion') == $seccion->id_seccion ? 'selected' : '' }}>
                                {{ $seccion->nombre_seccion }}
                            </option>
                        @endforeach
                    </select>
                    @error('seccion')
                        <div class="invalid-feedback d-flex justify-content-center align-items-center">
                            <strong>
                                {{ $message }}
                            </strong>
                        </div>
                    @enderror
                </div>

                <!-- Botón de búsqueda -->
                <div class="input-group-append ml-2 mr-4">
                    <button class="btn btn-success my-2 my-sm-0" type="submit" style="width: 120px; height: 37px;"><strong> Buscar </strong></button>
                </div>
            </div>
        </form>


    </nav>
    <br>

    <div id="mensaje1">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('datos') }}
                <button type="button" class="close" data-dismiss="alert" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <div id="mensaje2">
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('danger') }}
                <button type="button" class="close" data-dismiss="alert" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <table class="table text-center">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">Alumno</th>
                <th scope="col">Grado y Sección</th>
                <th scope="col">Apoderado</th>
                <th scope="col">Email Apoderado</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($alumnos) <= 0)
                <tr>
                    <td colspan="6">No hay registros</td>
                </tr>
            @else
                @foreach ($alumnos as $itemalumnos)
                    <tr>
                        <td>
                            {{ $itemalumnos->nombre_alumno . ' ' . $itemalumnos->apellido_alumno }}
                        </td>
                        <td>
                        {{ ucwords(
                            strtolower(
                                ($itemalumnos->seccion->grado->nombre_grado ?? 'Desconocido') . ' ' .
                                ($itemalumnos->seccion->nombre_seccion ?? 'Desconocida') . ' de ' .
                                ($itemalumnos->seccion->grado->nivel->nombre_nivel ?? 'Desconocido')
                            )
                        ) }}
                        </td>
                        <td>
                            {{ $itemalumnos->padre->user->name }}
                        </td>
                        <td>
                            {{ $itemalumnos->padre->user->email }}
                        <td>
                            {{ $itemalumnos->telefono }}
                        <td>

                            
                                @can('Editar Alumnos')
                                <a href="{{ route('Alumno.edit', $itemalumnos->id_alumno) }}" class="btn btn-info">
                                    <img src="{{ asset('plantilla\src\img\logo\editar_blanco.png') }}" alt="Editar"
                                        style="width: 30px; height: 30px;">
                                </a>
                                @endcan

                                @can('Eliminar Alumnos')
                                <a href="{{ route('Alumno.confirmar', $itemalumnos->id_alumno) }}" class="btn btn-danger">
                                    <img src="{{ asset('plantilla\src\img\logo\eliminar.png') }}" alt="Eliminar"
                                        style="width: 30px; height: 30px;">
                                </a>
                                @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <div>
            {{ $alumnos->appends(['buscarporNom' => $buscarporNom, 'buscarporApell' => $buscarporApell])->links() }}
        </div>

        @can('Generar Reporte de Alumnos')
            <div>
                <form action="{{ route('Alumno.generarPdf', [
                            'nivel' => request('nivel'),
                            'grado' => request('grado'),
                            'seccion' => request('seccion'),
                            ]) }}"
                                    
                    method="POST" target="{{ $nueva_pagina }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Reporte de Alumnos</button>
                </form>
            </div>
        @endcan
    </div>

@endsection('Contenido')
@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje1').remove();
        }, 3000);
    </script>
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje2').remove();
        }, 3000);
    </script>
@endsection
