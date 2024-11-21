@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> cursos por grado</h1>
    <br>
    <nav class="navbar navbar-light ">
        <form class="form-inline my-lg-0 m-2 ml-auto" method="GET">
            <div class="input-group ">

                <select class="form-control ml-2 mr-2" id="nivel" name="nivel" onchange="this.form.submit()"
                    style="width: 150px;">
                    <option value="" {{ !$nivel ? 'selected' : '' }}>Nivel</option>
                    @foreach ($niveles as $itemniveles)
                        <option value="{{ $itemniveles->id_nivel }}"
                            {{ $itemniveles->id_nivel == $nivel ? 'selected' : '' }}>
                            {{ $itemniveles->nombre_nivel }}
                        </option>
                    @endforeach
                </select>
                <select class="form-control ml-2 mr-2" id="grado" name="grado" onchange="this.form.submit()"
                    style="width: 150px;">
                    <option value="" {{ !$grado ? 'selected' : '' }}>Grado</option>
                    @foreach (App\Models\Grado::where('id_nivel', $nivel)->get() as $itemgrado)
                        <option value="{{ $itemgrado->id_grado }}" {{ $itemgrado->id_grado == $grado ? 'selected' : '' }}>
                            {{ $itemgrado->nombre_grado }}
                        </option>
                    @endforeach
                </select>

                <div class="input-group-append ml-2">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
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
                <th scope="col" class="w-25">Id</th>
                <th scope="col">Curso</th>
                <th scope="col">Grado</th>
                <th scope="col">Nivel</th>
            </tr>
        </thead>
        <tbody>
            @if (count($curso) <= 0)
                <tr>
                    <td colspan="4">No hay registros</td>
                </tr>
            @else
                @foreach ($curso as $itemcurso)
                    <tr>
                        <td>{{ $itemcurso->id_curso }}</td>
                        <td>{{ $itemcurso->nombre_curso }}</td>
                        <td>{{ $itemcurso->grado->nombre_grado }}</td>
                        <td>{{ $itemcurso->grado->nivel->nombre_nivel }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $curso->appends(['nivel' => $nivel, 'grado' => $grado])->onEachSide(0)->links() }}

@endsection('Contenido')
@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 3000);
    </script>
@endsection
