@extends('layout.plantilla')

@section('contenido')
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">LISTADO DE CATEGORIAS</h3>
      <br>

      <a href="{{ route('categoria.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
      <nav class="navbar navbar-light float-right">
        <form class="form-inline my-2 my-lg-0" method="GET">

          <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="Busqueda por descripcion" aria- label="Search">

          <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>

        </form>
      </nav>


      @section('script')
      <script>
        setTimeout(function() {
          document.querySelector('#mensaje').remove();
        }, 2000);
      </script>
      @endsection
      <div id="mensaje">
        @if (session('datos'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
          {{ session('datos') }}
          <button type="button" class="close" data-dismiss="alert" aria- label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Descripción</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @if(count($categoria)<=0) <tr>
            <td colspan="3">No hay registros</td>
            </tr>
            @else
            @foreach($categoria as $itemcategoria)
            <tr>
              <td>{{$itemcategoria->idcategoria}}</td>
              <td>{{$itemcategoria->descripcion}}</td>
              <td>
                <a href="{{ route('categoria.edit', $itemcategoria -> idcategoria) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                <a href="{{ route('categoria.confirmar', $itemcategoria -> idcategoria) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
              </td>
            </tr>
            @endforeach
            @endif
        </tbody>
      </table>

      {{ $categoria -> links() }}
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Footer
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>
@endsection