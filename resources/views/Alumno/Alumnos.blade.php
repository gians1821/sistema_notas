@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Lista de </strong>Alumnos Matriculados</h1>
    <br>
    <nav class="navbar navbar-light">
        
        <a href="{{ route('Alumno.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i><strong> Nuevo Registro </strong></a>

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
                <select class="form-control ml-2 mr-2" style="width: 130px;" id="nivel" name="nivel" onchange="this.form.submit()">
                    <option value="" selected>Nivel</option>
                    @foreach ($niveles as $itemniveles)
                        <option value="{{ $itemniveles->id_nivel }}"
                            {{ request('nivel') == $itemniveles->id_nivel ? 'selected' : '' }}>
                            {{ $itemniveles->nombre_nivel }}
                        </option>
                    @endforeach
                </select>

                <!-- Selección de grado -->
                <select class="form-control ml-2 mr-2" style="width: 130px;" id="grado" name="grado" onchange="this.form.submit()">
                    <option value="" selected>Grado</option>
                    <!-- Agrega opciones de grado dinámicamente o manualmente -->
                    @foreach (App\Models\Grado::where('id_nivel', $nivel)->get() as $grado)
                        <option value="{{ $grado->id_grado }}" {{ request('grado') == $grado->id_grado ? 'selected' : '' }}>
                            {{ $grado->nombre_grado }}
                        </option>
                    @endforeach
                </select>

                <!-- Selección de sección -->
                <select class="form-control ml-2 mr-2" style="width: 130px;" id="seccion" name="seccion" onchange="this.form.submit()">
                    <option value="" selected>Sección</option>
                    <!-- Agrega opciones de sección dinámicamente o manualmente -->
                    @foreach (App\Models\Seccion::where('grado_id_grado', request('grado'))->get() as $seccion)
                        <option value="{{ $seccion->id_seccion }}"
                            {{ request('seccion') == $seccion->id_seccion ? 'selected' : '' }}>
                            {{ $seccion->nombre_seccion }}
                        </option>
                    @endforeach
                </select>

                <!-- Botón de búsqueda -->
                <div class="input-group-append ml-2 mr-4">
                    <button class="btn btn-success my-2 my-sm-0" type="submit" style="width: 100px;"><strong> Buscar </strong></button>
                </div>
            </div>
        </form>


    </nav>
    <br>

    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('datos') }}
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
                <th scope="col">Teléfono</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($alumnos) <= 0)
                <tr>
                    <td colspan="5">No hay registros</td>
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
                        {{ $itemalumnos->padre->nombres . ' ' . $itemalumnos->padre->apellidos }}
                        </td>
                        <td>
                            {{ $itemalumnos->telefono }}
                        <td>

                            
                                <a href="{{ route('Alumno.edit', $itemalumnos->id_alumno) }}" class="btn btn-secondary">
                                    Constancia de Matrícula
                                </a>
                                <a href="{{ route('Alumno.edit', $itemalumnos->id_alumno) }}" class="btn btn-info">
                                    <img src="{{ asset('plantilla\src\img\logo\editar_blanco.png') }}" alt="Editar"
                                        style="width: 30px; height: 30px;">
                                </a>
                                <a href="{{ route('Alumno.confirmar', $itemalumnos->id_alumno) }}" class="btn btn-danger">
                                    <img src="{{ asset('plantilla\src\img\logo\eliminar.png') }}" alt="Eliminar"
                                        style="width: 30px; height: 30px;">
                                </a>
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
        <div>
            <form
                action="{{ route('Alumno.generarPdf', [
                    'idseccion' => $seccion ? $seccion->id_seccion : '0', // Usa '0' si $seccion es nulo
                ]) }}"
                method="POST" target="_blank">
                @csrf
                <button type="submit" class="btn btn-secondary">Generar PDF</button>
            </form>
        </div>
    </div>

@endsection('Contenido')
@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 3000);
    </script>
@endsection
