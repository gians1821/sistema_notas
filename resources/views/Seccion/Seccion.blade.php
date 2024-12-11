@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Grados y Secciones</h1>
    <br>
    <nav class="navbar navbar-light ">
        <a class="btn btn-primary " href="{{ route('Seccion.create') }}">
            <i class="fas fa-plus"></i> Nuevo Registro
        </a>
        <form class="form-inline my-lg-0 m-2" method="GET">
            <div class="input-group ">
            <div class="position-relative">

                    <select class="form-control ml-2 mr-2" style="width: 220px;" id="nivel" name="nivel" onchange="this.form.submit()">
                        <option value="" selected>Nivel</option>
                        @foreach ($niveles as $itemniveles)
                            <option value="{{ $itemniveles->id_nivel }}"
                                {{ request('nivel') == $itemniveles->id_nivel ? 'selected' : '' }}>
                                {{ $itemniveles->nombre_nivel }}
                            </option>
                        @endforeach
                    </select>
            </div>


            <div class="position-relative">
                    <select class="form-control ml-2 mr-2" style="width: 220px;" id="grado" name="grado" onchange="this.form.submit()">
                        <option value="" selected>Grado</option>
                        <!-- Agrega opciones de grado dinámicamente o manualmente -->
                        @foreach (App\Models\Grado::where('id_nivel', $nivel)->get() as $grado)
                            <option value="{{ $grado->id_grado }}" {{ request('grado') == $grado->id_grado ? 'selected' : '' }}>
                                {{ $grado->nombre_grado }}
                            </option>
                        @endforeach
                    </select>
            </div>

            <div class="position-relative">
                    <select class="form-control ml-2 mr-2" style="width: 220px;" id="seccion" name="seccion" onchange="this.form.submit()">
                        <option value="" selected>Sección</option>
                        <!-- Agrega opciones de sección dinámicamente o manualmente -->
                        @foreach (App\Models\Seccion::where('grado_id_grado', request('grado'))->get() as $seccion)
                            <option value="{{ $seccion->id_seccion }}"
                                {{ request('seccion') == $seccion->id_seccion ? 'selected' : '' }}>
                                {{ $seccion->nombre_seccion }}
                            </option>
                        @endforeach
                    </select>
            </div>

            </div>
        </form>
    </nav>

    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{ session('datos') }}
                <button type="button" class="close" data-dismiss="alert" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <br>
    <table class="table  text-center ">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="w-25">SECCION_ID</th>
                <th scope="col">NIVEL</th>
                <th scope="col">GRADO</th>
                <th scope="col">SECCION</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @if (count($filtro) <= 0)
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @else
                @foreach ($filtro as $itemseccion)
                    <tr>
                        <td>{{ $itemseccion->id_seccion }}</td>
                        <td>{{ $itemseccion->grado && $itemseccion->grado->nivel ? $itemseccion->grado->nivel->nombre_nivel : 'No asignado' }}
                        </td> <!-- Asegúrate de ajustar 'nombre_nivel' según el nombre real del campo en tu modelo Nivel -->
                        <td>{{ $itemseccion->grado ? $itemseccion->grado->nombre_grado : 'No asignado' }}</td>
                        <td>{{ $itemseccion->nombre_seccion }}</td>
                        <td>
                            <a href="{{ route('Seccion.confirmar', $itemseccion->id_seccion) }}"
                                class="btn btn-danger btnsm ms-2">
                                <img src="{{ asset('plantilla\src\img\logo\eliminar.png') }}" alt="Eliminar"
                                    style="width: 30px; height: 30px;">
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $filtro->appends(['seccion' => $seccion, 'grado' => $grado, 'nivel' => $nivel])->links() }};
@endsection('Contenido')
@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 3000);
    </script>
@endsection('script')
