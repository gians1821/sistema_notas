<!-- Confirmar eliminacion de Registro-->
<h1 class="h3 mb-3"><strong>Eliminar</strong> {{ ucfirst($tag_item) }}</h1>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">¿Estas seguro de eliminar este {{ strtolower($tag_item) }}?</h5>
        <form action="{{ $delete_route }}" method="POST">
            <h5>{{ ucfirst($tag_item) }}: {{ $field_item }} </h5>
            @method('delete')
            @csrf
            <p class="card-text">No podras recuperar la informacion una vez eliminada.</p>
            <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI </button>
            <a href="{{ $cancelar_route }}" class="btn btn-primary"><i class="fas fa-times-circle"></i>
                NO</button></a>
        </form>
    </div>
</div>