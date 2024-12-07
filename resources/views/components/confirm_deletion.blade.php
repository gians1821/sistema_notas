<!-- Confirmar eliminacion de Registro-->
<h1 class="h3 mb-3 text-danger"><strong>Eliminar</strong> {{ ucfirst($tag_item) }}</h1>
<div class="card border-danger">
    <div class="card-body">
        <h5 class="card-title text-danger">¿Estás seguro de eliminar este {{ strtolower($tag_item) }}?</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ ucfirst($tag_item) }}: <strong>{{ $field_item }}</strong></h6>
        <p class="card-text">No podrás recuperar la información una vez eliminada.</p>
        
        <form action="{{ $delete_route }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> Sí, Eliminar</button>
        </form>
        
        <a href="{{ $cancelar_route }}" class="btn btn-secondary"><i class="fas fa-times-circle"></i> No, Cancelar</a>
    </div>
</div>


<style>
    .card {
        border: 1px solid #dc3545; 
    }
    .text-danger {
        color: #dc3545 !important; 
    }
</style>