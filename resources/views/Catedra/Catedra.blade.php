@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> notas</h1>
    <br>

    <form class="form-inline my-2 my-lg-0" method="GET">
        <div class="input-group">

            <select class="form-control ml-2 mr-2" id="nivel" name="nivel" onchange="this.form.submit()">
                <option value="" selected>Nivel</option>
                @foreach ($nivel as $itemniveles)
                    <option value="{{ $itemniveles->id_nivel }}"
                        {{ request('nivel') == $itemniveles->id_nivel ? 'selected' : '' }}>
                        {{ $itemniveles->nombre_nivel }}
                    </option>
                @endforeach
            </select>

            <select class="form-control ml-2 mr-2" id="grado" name="grado" onchange="this.form.submit()">
                <option value="" selected>Grado</option>
                @foreach ($grado as $itemgrados)
                    <option value="{{ $itemgrados->id_grado }}"
                        {{ request('grado') == $itemgrados->id_grado ? 'selected' : '' }}>
                        {{ $itemgrados->nombre_grado }}
                    </option>
                @endforeach
            </select>

            <select class="form-control ml-2 mr-2" id="curso" name="curso">
                <option value="" selected>Curso</option>
                @foreach ($cursos as $itemcurso)
                    <option value="{{ $itemcurso->id_curso }}"
                        {{ request('curso') == $itemcurso->id_curso ? 'selected' : '' }}>
                        {{ $itemcurso->nombre_curso }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group-append ml-2 mr-4">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
        </div>
    </form>
    <br>
    <br>
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
    <table class="table text-center">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">Alumno</th>
                <th scope="col" class="w-25">Curso</th>
                <th scope="col">Nota 1</th>
                <th scope="col">Nota 2</th>
                <th scope="col">Nota 3</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($notas) <= 0)
                <tr>
                    <td colspan="3">No hay registros</td>
                </tr>
            @else
                @foreach ($notas as $nota)
                    <tr>
                        <td>
                            {{ $nota->alumno->nombre_alumno }} {{ $nota->alumno->apellido_alumno }}
                        </td>
                        <td>
                            {{ $nota->curso->nombre_curso }}
                        </td>
                        <td>
                            {{ $nota->nota1 }}
                        </td>
                        <td>
                            {{ $nota->nota2 }}
                        </td>
                        <td>
                            {{ $nota->nota3 }}
                        </td>
                        <td>
                            @role('Docente')
                                <a href="{{ route('Nota.edit', ['id_alumno' => $nota->alumno_id_alumno, 'id_curso' => $nota->curso_id_curso]) }}"
                                    class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                            @endrole
                            @role('Admin')
                                <a href="{{ route('Nota.edit', ['id_alumno' => $nota->alumno_id_alumno, 'id_curso' => $nota->curso_id_curso]) }}"
                                    class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                            @endrole
                            <a href="{{ route('Catedra.pdfalumno', ['id_alumno' => $nota->alumno_id_alumno]) }}"
                                class="btn btn-secondary" target="_blank">PDF</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
    <div class="d-flex justify-content-between">
        <div>
            {{ $notas->appends(['curso' => $cursoId])->links() }}
        </div>
        <div>
            <a href="{{ route('Catedra.pdf', ['curso' => $cursoId]) }}" class="btn btn-secondary" target="_blank">Generar
                PDF</a>
        </div>
    </div>

@endsection('Contenido')
