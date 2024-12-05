<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @if (count($data) <= 0)
            <tr>
                <td colspan="3">No hay registros</td>
            </tr>
        @else
            @foreach ($data as $item)
                <tr>
                    @foreach ($columns_data as $property)
                        <td>{{ $item->$property }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route($edit_route, $item->{$columns_data[0]}) }}" class="btn btn-info">
                            <img src="{{ asset('plantilla/src/img/logo/editar_blanco.png') }}" alt="Editar"
                                style="width: 30px; height: 30px;">
                        </a>
                        <a href="{{ route($delete_route, $item->{$columns_data[0]}) }}" class="btn btn-danger">
                            <img src="{{ asset('plantilla/src/img/logo/eliminar.png') }}" alt="Eliminar"
                                style="width: 30px; height: 30px;">
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
